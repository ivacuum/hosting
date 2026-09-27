# HTTP Client Guidelines

Start with typed, discoverable operations designed for application needs. Favor excellent developer experience. Use the examples as a baseline and add infrastructure as the integration needs it.

## Client Structure

- Clients expose typed application operations, not arbitrary HTTP requests; clients don't have to mirror the external API.
- Requests own the HTTP method, path, query, body, and operation-specific policies. Call `PendingRequest` methods directly; avoid a generic options abstraction.
- Responses inspect the complete Laravel HTTP response, handle service-specific errors, and expose typed application data. Keep request and response classes independent; the client connects them.
- Inject Laravel's HTTP `Factory`. Use a private `http()` for shared authentication, base URL, timeouts, and service attributes; use a private `sendRequest()` to delegate to the request.
- Use shared actions for reusable transport mechanics, not service-specific decisions. Do not add caching, retries, or correlation unless needed.

Example classes below belong in separate files in the relevant domain. Imports are shown together for brevity.

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

Use the integration's actual `ExternalService` case; `Example` is used here for the example host.

## Caching

- Opt in with `CacheableRequest` alongside `HttpRequest`: the request declares `cacheKey()`, `cacheTtl()`, and `shouldCache(Response)`. Shared infrastructure owns storage and response reconstruction.
- Cache safe reads and successful application results by default. Give negative caching an explicit policy and scope.
- Ordinary response keys include service, operation, key version, response-varying inputs, and authentication scope. Hash sensitive inputs; use shared service-wide keys only for deliberately service-wide policies.
- Cache response snapshots so the same parser works on misses and hits. Cacheable parsers should depend only on status, headers, body, protocol version, and reason phrase.
- Keep cache failures from breaking available integrations. Add stampede protection where concurrent misses justify it.

For example, a country list changes rarely. This endpoint returns the same list for every caller, so we can use a shared key and a one-week TTL.

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

`HttpStash` is the shared caching helper, provided separately. Inject `HttpStash $stash` alongside the client's existing dependencies:

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

## Retries and Idempotency

- Opt in per operation: requests classify transient failures and bound attempts and total elapsed time. Shared helpers may implement mechanics, but requests own the policy.
- Retry only operations safe to repeat, with replayable bodies. For writes, use inherent idempotency or a service-supported idempotency key kept stable across immediate and queue retries.
- Respect service retry metadata; use backoff and jitter where needed. Move long delays to queued work.
- When correlation is useful, pass a stable operation ID in a service-supported header across attempts and queue retries. Keep it separate from the idempotency key.

For a service supporting `Idempotency-Key`, this write retries connection failures only. The caller creates and persists the key with the logical operation, then reuses the same key and payload on queue retries.

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

## Logging

- Reuse Laravel HTTP event logging existing in the app; keep logging mechanics out of clients.
- Identify known services with a `service` request attribute containing an `ExternalService` value.
- Review credential exposure in requests, responses, and reported exceptions when adding an integration. Update service-specific filtering and cover relevant success and failure payloads.
- Use `withAttributes(['skip_response_body_logging' => true])` to opt out of saving the response body to logs when the logging layer supports this attribute, for example for downloads.

## Testing and Fakes

- Provide one discoverable fake class per service, with methods named after client operations and meaningful failures. Add only scenarios needed by tests, not arbitrary status/payload builders.
- Keep representative fake payloads beside response parsers; let service fakes map them to URL patterns and return arrays for `Http::fake()`. Use narrow operation patterns and broad patterns only for service-wide failures.
- Application tests use service fakes to stay independent of endpoint URLs and external payload fields. Focused client/request tests verify the outgoing contract and error handling.

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
