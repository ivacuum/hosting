<?php

namespace App\Domain\Magnet\RateLimit;

use App\Domain\RateLimit;
use App\Domain\RateLimit\Action\LimitRateAction;

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
