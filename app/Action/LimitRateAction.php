<?php namespace App\Action;

use Illuminate\Cache\RateLimiting\Limit;

class LimitRateAction
{
    public function __construct(
        private LimitRateWithCacheAction $limitRateWithCache,
        private LimitRateWithRedisAction $limitRateWithRedis,
    ) {
    }

    public function execute(Limit $limit): bool
    {
        if (app()->runningUnitTests()) {
            return $this->limitRateWithCache->execute($limit);
        }

        return $this->limitRateWithRedis->execute($limit);
    }
}
