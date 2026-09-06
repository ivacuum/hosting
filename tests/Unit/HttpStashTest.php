<?php

namespace Tests\Unit;

use App\Http\CacheableRequest;
use App\Http\HttpRequest;
use App\Http\HttpStash;
use Carbon\CarbonInterval;
use Illuminate\Cache\Events\CacheEvent;
use Illuminate\Cache\Events\RetrievingKey;
use Illuminate\Cache\Events\WritingKey;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\TestWith;
use Psr\Http\Message\StreamInterface;
use Tests\TestCase;

class HttpStashTest extends TestCase
{
    use DatabaseTransactions;

    public function testCachesResponseFieldsWithoutChangingOriginalResponse(): void
    {
        Http::fake([
            'https://example.com/details' => Factory::response(['name' => 'Example']),
        ]);

        $stash = app(HttpStash::class);
        $request = $this->cacheableRequest();
        $original = null;

        $fresh = $stash->store($request, function () use ($request, &$original): Response {
            return $original = $request->send(Http::createPendingRequest());
        });

        $cached = $stash->store($request, fn () => $request->send(Http::createPendingRequest()));

        $this->assertSame($original, $fresh);
        $this->assertTrue(Cache::has($request->cacheKey()));
        $this->assertNotSame($fresh, $cached);
        $this->assertSame(['name' => 'Example'], $cached->json());
        Http::assertSentCount(1);
    }

    #[TestWith([200, false], 'semantic failure')]
    #[TestWith([404, true], 'client error')]
    #[TestWith([500, true], 'server error')]
    public function testDoesNotCacheRejectedResponses(int $status, bool $shouldCache): void
    {
        Http::fake([
            'https://example.com/details' => Factory::response('body', $status),
        ]);

        $stash = app(HttpStash::class);
        $request = $this->cacheableRequest($shouldCache);

        $response = $stash->store($request, fn () => $request->send(Http::createPendingRequest()));

        $this->assertSame($status, $response->status());
        $this->assertSame('body', $response->body());
        $this->assertFalse(Cache::has($request->cacheKey()));
        Http::assertSentCount(1);
    }

    #[TestWith([false, true], 'unreadable')]
    #[TestWith([true, false], 'nonseekable')]
    public function testDoesNotReadUncacheableStreams(bool $readable, bool $seekable): void
    {
        $stream = \Mockery::mock(StreamInterface::class);
        $stream->shouldReceive('isReadable')->andReturn($readable);
        $stream->shouldReceive('isSeekable')->andReturn($seekable);
        $stream->shouldNotReceive('getContents');
        $stream->shouldNotReceive('read');
        $stream->shouldNotReceive('__toString');
        $response = new Response(Factory::psr7Response($stream));
        $request = $this->cacheableRequest();

        $this->assertSame($response, app(HttpStash::class)->store($request, fn () => $response));
        $this->assertFalse(Cache::has($request->cacheKey()));
    }

    #[TestWith([RetrievingKey::class], 'cache read failure')]
    #[TestWith([WritingKey::class], 'cache write failure')]
    public function testPreservesHttpResponseWhenCacheFails(string $event): void
    {
        Exceptions::fake();
        Http::fake([
            'https://example.com/details' => Factory::response('body'),
        ]);

        $request = $this->cacheableRequest();
        $failure = new \RuntimeException('Cache unavailable.');

        Event::listen($event, static function (CacheEvent $event) use ($request, $failure): void {
            if ($event->key === $request->cacheKey()) {
                throw $failure;
            }
        });

        $response = app(HttpStash::class)->store($request, fn () => $request->send(Http::createPendingRequest()));

        $this->assertSame(200, $response->status());
        $this->assertSame('body', $response->body());
        Http::assertSentCount(1);
        Exceptions::assertReported(fn (\RuntimeException $exception): bool => $exception === $failure);
        Exceptions::assertReportedCount(1);
    }

    #[TestWith([false])]
    #[TestWith([true])]
    public function testPropagatesHttpFailureWithoutRetrying(bool $cacheFails): void
    {
        Exceptions::fake();
        Http::fake([
            'https://example.com/details' => Http::failedConnection('Connection failed.'),
        ]);

        $request = $this->cacheableRequest();

        if ($cacheFails) {
            $failure = new \RuntimeException('Cache unavailable.');

            Event::listen(RetrievingKey::class, static function (RetrievingKey $event) use ($request, $failure): void {
                if ($event->key === $request->cacheKey()) {
                    throw $failure;
                }
            });
        }

        $this->assertThrows(
            fn () => app(HttpStash::class)->store($request, fn () => $request->send(Http::createPendingRequest())),
            fn (ConnectionException $exception): bool => $exception->getMessage() === 'Connection failed.',
        );

        Http::assertSentCount(1);
        $this->assertNull(Cache::store()->getStore()->get($request->cacheKey()));
        Exceptions::assertNotReported(ConnectionException::class);
        Exceptions::assertReportedCount($cacheFails ? 1 : 0);
    }

    public function testSendsNonCacheableRequestsEveryTime(): void
    {
        Http::fake([
            'https://example.com/details' => Factory::response('body'),
        ]);

        $stash = app(HttpStash::class);
        $request = new class implements HttpRequest {
            public function send(PendingRequest $http): Response
            {
                return $http->get('https://example.com/details');
            }
        };
        $send = fn () => $request->send(Http::createPendingRequest());

        $this->assertSame('body', $stash->store($request, $send)->body());
        $this->assertSame('body', $stash->store($request, $send)->body());
        Http::assertSentCount(2);
    }

    private function cacheableRequest(bool $shouldCache = true): HttpRequest&CacheableRequest
    {
        return new class($shouldCache) implements CacheableRequest, HttpRequest {
            public function __construct(private bool $shouldCache) {}

            public function cacheKey(): string
            {
                return 'http.example.details.v1';
            }

            public function cacheTtl(): CarbonInterval
            {
                return CarbonInterval::minutes(15);
            }

            public function send(PendingRequest $http): Response
            {
                return $http->get('https://example.com/details');
            }

            public function shouldCache(Response $response): bool
            {
                return $this->shouldCache;
            }
        };
    }
}
