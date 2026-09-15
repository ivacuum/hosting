<?php

namespace App\Domain\Rto;

use App\Domain\CacheKey;
use App\Http\CacheableRequest;
use App\Http\HttpRequest;
use Carbon\CarbonInterval;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class RtoTopicDataRequest implements CacheableRequest, HttpRequest
{
    /** @param list<int> $ids */
    public function __construct(private array $ids) {}

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
        return $http->get('https://api-rto.vacuum.name/v1/get_tor_topic_data', [
            'by' => 'topic_id',
            'val' => implode(',', $this->ids),
        ]);
    }

    public function shouldCache(Response $response): bool
    {
        return $response->json('error.code') === 1
            && $response->json('error.text') === 'Temporarily disabled';
    }
}
