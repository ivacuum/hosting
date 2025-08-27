<?php

namespace App\Domain\RateLimit\Action;

use App\Domain\RateLimit\Events\RateLimitExceeded;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Redis\Factory;
use Illuminate\Redis\Limiters\DurationLimiter;

class LimitRateWithRedisAction
{
    public function __construct(private Factory $redis) {}

    public function execute(Limit $limit): bool
    {
        if ($limit->maxAttempts === 0) {
            return false;
        }

        $limiter = new DurationLimiter(
            $this->redis, $limit->key, $limit->maxAttempts, $limit->decaySeconds
        );

        if ($limiter->tooManyAttempts()) {
            event(new RateLimitExceeded($limit->key, $limit->maxAttempts));

            return true;
        }

        $limiter->acquire();

        return false;
    }
}
