<?php namespace App\Http;

use App\Domain\CacheKey;
use Carbon\CarbonInterval;

interface CacheableRequest
{
    public function cacheKey(): CacheKey;

    public function cacheTtl(): CarbonInterval;
}
