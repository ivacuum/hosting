<?php

namespace Tests\Feature;

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
use Tests\TestCase;

class ExternalHttpRequestLoggingTest extends TestCase
{
    use DatabaseTransactions;

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

    private function responseHandler(): callable
    {
        return static function (RequestInterface $request, array $options): PromiseInterface {
            $response = Factory::psr7Response(
                ['id' => 555],
                headers: ['X-Request-Id' => 'request-123'],
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
