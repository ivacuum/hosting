<?php

namespace App\Http;

use Illuminate\Cache\Repository;
use Illuminate\Http\Client\Response;

class HttpStash
{
    public function __construct(private Repository $cache) {}

    public function store(HttpRequest $request, callable $fn): Response
    {
        if (!$request instanceof CacheableRequest) {
            return $fn();
        }

        $key = $request->cacheKey();
        $cachedResponse = rescue(fn (): array|null => $this->cache->get($key));

        if ($cachedResponse !== null) {
            return HttpResponseSnapshot::toResponse($cachedResponse);
        }

        $response = $fn();
        $body = $response->toPsrResponse()->getBody();

        if ($response->successful() && $body->isReadable() && $body->isSeekable() && $request->shouldCache($response)) {
            $cachedResponse = HttpResponseSnapshot::fromResponse($response);
            $ttl = $request->cacheTtl();

            rescue(fn () => $this->cache->put($key, $cachedResponse, $ttl));
        }

        return $response;
    }
}
