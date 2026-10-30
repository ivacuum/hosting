# HTTP client guidelines

Build each client around the operations the application needs, with typed inputs and outputs. Favor excellent developer experience. Start from the examples below. Add caching, retries, or correlation only when the integration needs them.

## Expose typed operations, not raw HTTP

- A client exposes typed application operations, not arbitrary HTTP requests. Its methods don't have to mirror the external API.
- A request class owns the HTTP method, path, query, body, and operation-specific policies. It calls `PendingRequest` methods directly. Don't add a generic options abstraction.
- A response class reads the complete Laravel HTTP `Response`, handles service-specific errors, and exposes typed application data.
- Request and response classes don't depend on each other. The client connects them.
- The client injects Laravel's HTTP `Factory`. A private `http()` method sets the shared authentication, base URL, timeouts, and service attributes. A private `sendRequest()` method passes that `PendingRequest` to the request.
- Shared actions hold reusable transport mechanics, not service-specific decisions.

Put each class below in its own file in the relevant domain. The examples list all imports together to save space.

```php
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Container\Attributes\Config;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

enum ExternalService: string
{
    case Example = 'example';
}

interface HttpRequest
{
    public function send(PendingRequest $http): Response;
}

readonly class AcmeFindCustomerRequest implements HttpRequest
{
    public function __construct(private int $customerId) {}

    public function send(PendingRequest $http): Response
    {
        return $http->get("contacts/{$this->customerId}");
    }
}

readonly class AcmeCustomerResponse
{
    public int $id;
    public string $name;

    public function __construct(public Response $response)
    {
        $this->id = $response->json('contact_id');
        $this->name = $response->json('display_name');
    }

    public static function fakeSuccess(int $id = 123, string $name = 'Example Customer'): PromiseInterface
    {
        return Factory::response([
            'contact_id' => $id,
            'display_name' => $name,
        ]);
    }
}

class AcmeApi
{
    public function __construct(
        private readonly Factory $http,
        #[Config('services.acme.token')]
        #[\SensitiveParameter]
        private readonly string $token,
    ) {}

    public function findCustomer(int $customerId): AcmeCustomerResponse
    {
        $request = new AcmeFindCustomerRequest($customerId);

        return new AcmeCustomerResponse($this->sendRequest($request));
    }

    private function http(): PendingRequest
    {
        return $this->http
            ->createPendingRequest()
            ->baseUrl('https://example.com/v1')
            ->connectTimeout(3)
            ->timeout(15)
            ->withToken($this->token)
            ->withAttributes(['service' => ExternalService::Example])
            ->throw();
    }

    private function sendRequest(HttpRequest $request): Response
    {
        return $request->send($this->http());
    }
}
```

`ExternalService::Example` stands in for the example host. A real client uses the case for its own service.

## Cache only when the request opts in

- A request opts in to caching by implementing `CacheableRequest` next to `HttpRequest`. It declares `cacheKey()`, `cacheTtl()`, and `shouldCache(Response)`. Shared infrastructure stores the response and rebuilds it on a hit.
- By default, cache safe reads and successful application results. Caching a negative result needs its own explicit policy and scope.
- An ordinary cache key includes the service, the operation, a key version, every input that changes the response, and the authentication scope. Hash sensitive inputs. Use a key shared by the whole service only for a deliberate service-wide policy.
- Cache a snapshot of the response, so the same parser reads both misses and hits. A cacheable parser reads only the status, headers, body, protocol version, and reason phrase.
- A cache failure must not break an integration that is otherwise available.
- Add protection against cache stampedes only when concurrent misses are a real cost.

For example, a country list rarely changes, and the endpoint returns the same list to every caller. The request uses a shared key and a one-week TTL:

```php
use Carbon\CarbonInterval;

interface CacheableRequest
{
    public function cacheKey(): string;

    public function cacheTtl(): CarbonInterval;

    public function shouldCache(Response $response): bool;
}

readonly class AcmeCountriesRequest implements HttpRequest, CacheableRequest
{
    public function cacheKey(): string
    {
        return 'http.acme.countries.v1';
    }

    public function cacheTtl(): CarbonInterval
    {
        return CarbonInterval::week();
    }

    public function send(PendingRequest $http): Response
    {
        return $http->get('countries');
    }

    public function shouldCache(Response $response): bool
    {
        $countries = $response->json('countries');

        return is_array($countries) && $countries !== [];
    }
}

readonly class AcmeCountriesResponse
{
    /** @var list<array{code: string, name: string}> */
    public array $countries;

    public function __construct(public Response $response)
    {
        $this->countries = $response->json('countries');
    }
}
```

`HttpStash` is the shared caching helper. It is not shown here. To route requests through the cache, inject `HttpStash $stash` next to the client's other dependencies and call it from `sendRequest()`:

```php
public function countries(): AcmeCountriesResponse
{
    $request = new AcmeCountriesRequest;

    return new AcmeCountriesResponse($this->sendRequest($request));
}

private function sendRequest(HttpRequest $request): Response
{
    return $this->stash->store($request, fn () => $request->send($this->http()));
}
```

## Retry only operations that are safe to repeat

- Each operation opts in to retries. The request decides which failures are transient and limits both the number of attempts and the total time. Shared helpers may implement the mechanics, but the request owns the policy.
- Retry only an operation that is safe to repeat and has a body you can send again. For a write, rely on an operation that is idempotent by nature or on an idempotency key that the service supports. Keep that key the same across immediate retries and queue retries.
- Respect the retry metadata that the service returns. Add backoff and jitter where the service needs them. Move long delays to a queued job.
- To correlate attempts, send a stable operation ID in a header that the service supports. Keep the same ID across attempts and queue retries. Keep the operation ID separate from the idempotency key.

The following write targets a service that supports `Idempotency-Key` and retries only connection failures. The caller creates the key, stores it with the logical operation, and sends the same key and payload on every queue retry.

```php
use Illuminate\Http\Client\ConnectionException;

readonly class AcmeCreateCustomerRequest implements HttpRequest
{
    public function __construct(
        private string $name,
        private string $idempotencyKey,
    ) {}

    public function send(PendingRequest $http): Response
    {
        return $http
            ->withHeader('Idempotency-Key', $this->idempotencyKey)
            ->timeout(5)
            ->retry([200, 500], when: static fn (\Throwable $exception): bool => $exception instanceof ConnectionException)
            ->post('contacts', [
                'display_name' => $this->name,
            ]);
    }
}
```

## Leave logging to the event listener

- If the app already logs Laravel HTTP client events, reuse that logging. Keep logging code out of clients.
- Identify a known service by setting the `service` request attribute to an `ExternalService` case.
- When you add an integration, check whether credentials leak into logged requests, logged responses, or reported exceptions. Update the filtering for that service, and test it with the relevant success and failure payloads.
- To keep a response body out of the log, set `withAttributes(['skip_response_body_logging' => true])`, for example for downloads. The attribute works only if the logging layer supports it.

## Fake each service through one class

- Give each service one fake class. Name its methods after the client operations and after the failures that matter. Add only the scenarios that tests need. Don't add builders for arbitrary statuses or payloads.
- Keep representative fake payloads next to the response parser. The service fake maps those payloads to URL patterns and returns an array for `Http::fake()`. Use a narrow pattern for each operation. Use a broad pattern only for a failure that affects the whole service.
- Application tests use the service fake, so they don't depend on endpoint URLs or external payload fields. Focused client and request tests check the outgoing request and the error handling.

```php
class AcmeApiFake
{
    public static function findCustomer(int $id = 123, string $name = 'Example Customer'): array
    {
        return ["example.com/v1/contacts/{$id}" => AcmeCustomerResponse::fakeSuccess($id, $name)];
    }
}

// Inside an application test:
config(['services.acme.token' => 'secret-token']);
\Http::fake(AcmeApiFake::findCustomer(123, 'Alice'));

$response = app(AcmeApi::class)->findCustomer(123);

$this->assertSame(123, $response->id);
$this->assertSame('Alice', $response->name);
```
