<?php

namespace App\RateLimit;

use App\Action\LimitRateAction;
use Illuminate\Cache\RateLimiting\Limit;

class MagnetRateLimiter
{
    public function __construct(private LimitRateAction $limitRate) {}

    public function tooManyAttempts(): bool
    {
        return $this->globalLimitExceeded();
    }

    private function globalLimitExceeded(): bool
    {
        $limit = Limit::perDay(config('cfg.limits.magnet.per_day'))
            ->by('magnet.per_day');

        return $this->limitRate->execute($limit);
    }
}
