<?php

namespace App\Http;

use Carbon\CarbonInterval;
use Illuminate\Http\Client\Response;

interface CacheableRequest
{
    public function cacheKey(): string;

    public function cacheTtl(): CarbonInterval;

    public function shouldCache(Response $response): bool;
}
