<?php

namespace App\Domain\Rto;

use App\Domain\CacheKey;
use App\Http\CacheableRequest;
use App\Http\HttpRequest;
use Carbon\CarbonInterval;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class RtoTopicIdRequest implements CacheableRequest, HttpRequest
{
    public function __construct(private string $hash) {}

    public function cacheKey(): string
    {
        return CacheKey::RtoApiUnavailable->value;
    }

    public function cacheTtl(): CarbonInterval
    {
        return CacheKey::RtoApiUnavailable->ttl();
    }

    public function send(PendingRequest $http): Response
    {
        return $http->get('https://api.rutracker.cc/v1/get_topic_id', [
            'by' => 'hash',
            'val' => $this->hash,
        ]);
    }

    public function shouldCache(Response $response): bool
    {
        return $response->json('error.code') === 1
            && $response->json('error.text') === 'Temporarily disabled';
    }
}
