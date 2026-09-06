<?php

namespace Tests\Feature;

use App\Domain\Log\ExternalService;
use App\Domain\Log\HttpFailureCategory;
use App\Domain\Log\Models\ExternalHttpRequest;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\TransferStats;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Tests\TestCase;

class ExternalHttpRequestLoggingTest extends TestCase
{
    use DatabaseTransactions;

    public function testDoesNotLogBinaryBodies(): void
    {
        $requestBody = "\x00\x01\x02\xFF";
        $responseBody = "\xFF\xD8\xFF\xE0\x00\x10";

        Http::fake([
            'https://example.com/v2/binary' => Factory::response(
                $responseBody,
                headers: ['Content-Type' => 'image/jpeg'],
            ),
        ]);

        Http::withBody($requestBody, 'application/octet-stream')
            ->post('https://example.com/v2/binary');

        $request = ExternalHttpRequest::query()->latest('id')->firstOrFail();

        $this->assertSame('example.com', $request->host);
        $this->assertSame('/v2/binary', $request->path);
        $this->assertSame('', $request->request_body);
        $this->assertSame('', $request->response_body);
        $this->assertSame(strlen($responseBody), $request->response_size);
    }

    public function testDoesNotLogStreamedResponseBody(): void
    {
        $body = 'Downloaded text that must not be logged.';

        Http::fake([
            'https://example.com/v2/streamed' => Factory::response(
                $body,
                headers: ['Content-Type' => 'text/plain'],
            ),
        ]);

        $tempFile = tmpfile();

        $this->assertIsResource($tempFile);

        try {
            Http::withAttributes(['skip_response_body_logging' => true])
                ->sink($tempFile)
                ->get('https://example.com/v2/streamed');

            $request = ExternalHttpRequest::query()->latest('id')->firstOrFail();

            $this->assertSame('example.com', $request->host);
            $this->assertSame('/v2/streamed', $request->path);
            $this->assertSame('', $request->response_body);
            $this->assertSame(strlen($body), $request->response_size);
            $this->assertSame($body, stream_get_contents($tempFile));
        } finally {
            fclose($tempFile);
        }
    }

    public function testLogsConnectionFailure(): void
    {
        Http::allowStrayRequests(['https://api.wanikani.com/*']);

        try {
            Http::setHandler($this->connectionFailureHandler())
                ->get('https://api.wanikani.com/v2/subjects/555');
            $this->fail('A connection exception was not thrown.');
        } catch (ConnectionException) {
        }

        $request = ExternalHttpRequest::query()->latest('id')->firstOrFail();

        $this->assertSame(ExternalService::Wanikani, $request->service_name);
        $this->assertSame('api.wanikani.com', $request->host);
        $this->assertSame('/v2/subjects/555', $request->path);
        $this->assertNull($request->http_code);
        $this->assertSame(100, $request->queue_time_us);
        $this->assertSame(10_000, $request->namelookup_time_us);
        $this->assertSame(10_000, $request->connect_time_us);
        $this->assertSame(0, $request->appconnect_time_us);
        $this->assertSame(10_000, $request->pretransfer_time_us);
        $this->assertSame(10_000, $request->posttransfer_time_us);
        $this->assertSame(10_000, $request->starttransfer_time_us);
        $this->assertSame(10_100, $request->total_time_us);
        $this->assertSame(0, $request->redirect_time_us);
        $this->assertSame('', $request->primary_ip);
        $this->assertNull($request->primary_port);
        $this->assertSame('', $request->local_ip);
        $this->assertNull($request->local_port);
        $this->assertSame(1, $request->ssl_verify_result);
        $this->assertTrue($request->used_proxy);
        $this->assertSame(6, $request->curl_errno);
        $this->assertSame(8, $request->os_errno);
        $this->assertSame(HttpFailureCategory::Dns, $request->failure_category);
        $this->assertSame('Could not resolve host: api.wanikani.com', $request->curl_error);
    }

    public function testLogsResponse(): void
    {
        Http::allowStrayRequests(['https://api.wanikani.com/*']);

        Http::setHandler($this->responseHandler())
            ->withHeader('X-Test', 'value')
            ->get('https://api.wanikani.com/v2/subjects/555');

        $request = ExternalHttpRequest::query()->latest('id')->firstOrFail();

        $this->assertSame('api.wanikani.com', $request->host);
        $this->assertSame('/v2/subjects/555', $request->path);
        $this->assertSame(200, $request->http_code);
        $this->assertSame(['value'], $request->request_headers['X-Test']);
        $this->assertSame(['id' => 555], json_decode($request->response_body, true));
        $this->assertSame(['X-Request-Id' => ['request-123'], 'Content-Type' => ['application/json']], $request->response_headers);
        $this->assertSame(100, $request->queue_time_us);
        $this->assertSame(10_000, $request->namelookup_time_us);
        $this->assertSame(30_000, $request->connect_time_us);
        $this->assertSame(80_000, $request->appconnect_time_us);
        $this->assertSame(85_000, $request->pretransfer_time_us);
        $this->assertSame(90_000, $request->posttransfer_time_us);
        $this->assertSame(200_000, $request->starttransfer_time_us);
        $this->assertSame(250_000, $request->total_time_us);
        $this->assertSame(5_000, $request->redirect_time_us);
        $this->assertSame('203.0.113.10', $request->primary_ip);
        $this->assertSame(443, $request->primary_port);
        $this->assertSame('192.0.2.10', $request->local_ip);
        $this->assertSame(51_234, $request->local_port);
        $this->assertSame(0, $request->ssl_verify_result);
        $this->assertFalse($request->used_proxy);
        $this->assertNull($request->curl_errno);
        $this->assertNull($request->os_errno);
        $this->assertNull($request->failure_category);
        $this->assertNull($request->curl_error);
    }

    private function connectionFailureHandler(): callable
    {
        return static fn (RequestInterface $request): PromiseInterface => Create::rejectionFor(
            new ConnectException('Could not resolve host', $request, handlerContext: [
                'errno' => 6,
                'error' => 'Could not resolve host: api.wanikani.com',
                'os_errno' => 8,
                'queue_time_us' => 100,
                'namelookup_time_us' => 10_000,
                'connect_time_us' => 10_000,
                'pretransfer_time_us' => 10_000,
                'posttransfer_time_us' => 10_000,
                'starttransfer_time_us' => 10_000,
                'total_time_us' => 10_100,
                'primary_ip' => '',
                'primary_port' => -1,
                'local_ip' => '',
                'local_port' => -1,
                'ssl_verify_result' => 1,
                'used_proxy' => 1,
            ]),
        );
    }

    private function responseHandler(
        array|string|StreamInterface $body = ['id' => 555],
        array $headers = ['X-Request-Id' => 'request-123'],
    ): callable {
        return static function (RequestInterface $request, array $options) use ($body, $headers): PromiseInterface {
            $response = Factory::psr7Response(
                $body,
                headers: $headers,
            );

            $options['on_stats'](new TransferStats($request, $response, 0.25, handlerStats: [
                'queue_time_us' => 100,
                'namelookup_time_us' => 10_000,
                'connect_time_us' => 30_000,
                'appconnect_time' => 0.08,
                'pretransfer_time_us' => 85_000,
                'posttransfer_time_us' => 90_000,
                'starttransfer_time_us' => 200_000,
                'total_time_us' => 250_000,
                'redirect_time' => 0.005,
                'primary_ip' => '203.0.113.10',
                'primary_port' => 443,
                'local_ip' => '192.0.2.10',
                'local_port' => 51_234,
                'ssl_verify_result' => 0,
                'used_proxy' => 0,
                'http_version' => 2,
            ]));

            return Create::promiseFor($response);
        };
    }
}
