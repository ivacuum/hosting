<?php

namespace App\Domain\RateLimit\Action;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Container\Attributes\Config;

class LimitRateAction
{
    public function __construct(
        #[Config('cache.default')]
        private string $cacheStore,
        private LimitRateWithCacheAction $limitRateWithCache,
        private LimitRateWithRedisAction $limitRateWithRedis,
    ) {}

    public function execute(Limit $limit): bool
    {
        if ($this->cacheStore === 'redis') {
            return $this->limitRateWithRedis->execute($limit);
        }

        return $this->limitRateWithCache->execute($limit);
    }
}
