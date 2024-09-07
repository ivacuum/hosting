<?php

namespace App\RateLimit;

use App\Action\LimitRateAction;
use App\Domain\RateLimit;

class MagnetRateLimiter
{
    public function __construct(private LimitRateAction $limitRate) {}

    public function tooManyAttempts(): bool
    {
        return $this->globalLimitExceeded();
    }

    private function globalLimitExceeded(): bool
    {
        $limit = RateLimit::MagnetGlobal
            ->get()
            ->by('magnet.per_day');

        return $this->limitRate->execute($limit);
    }
}
