<?php namespace App\Action;

use App\Events\RateLimitExceeded;
use Illuminate\Cache\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;

class LimitRateWithCacheAction
{
    public function __construct(private RateLimiter $limiter)
    {
    }

    public function execute(Limit $limit): bool
    {
        if ($limit->maxAttempts === 0) {
            return false;
        }

        if ($this->limiter->tooManyAttempts($limit->key, $limit->maxAttempts)) {
            event(new RateLimitExceeded($limit->key, $limit->maxAttempts));

            return true;
        }

        $this->limiter->hit($limit->key, $limit->decayMinutes * 60);

        return false;
    }
}
