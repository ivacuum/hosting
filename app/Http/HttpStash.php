<?php

namespace App\Http;

use Illuminate\Cache\Repository;
use Illuminate\Http\Client\Response;

class HttpStash
{
    public function __construct(private Repository $cache) {}

    public function store(HttpRequest $request, callable $fn): Response
    {
        if ($request instanceof CacheableRequest) {
            $cachedResponse = $this->cache->remember(
                $request->cacheKey(),
                $request->cacheTtl(),
                static fn () => CachedResponse::fromResponse($fn())
                    ->jsonSerialize(),
            );

            return CachedResponse::toResponse($cachedResponse);
        }

        return $fn();
    }
}
