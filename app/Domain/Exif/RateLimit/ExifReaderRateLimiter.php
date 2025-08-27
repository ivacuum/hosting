<?php

namespace App\Domain\Exif\RateLimit;

use App\Domain\RateLimit;
use App\Domain\RateLimit\Action\LimitRateAction;

class ExifReaderRateLimiter
{
    public function __construct(private LimitRateAction $limitRate) {}

    public function tooManyAttempts(): bool
    {
        return $this->globalLimitExceeded();
    }

    private function globalLimitExceeded(): bool
    {
        $limit = RateLimit::ExifReader
            ->get()
            ->by('exif-reader.per_hour');

        return $this->limitRate->execute($limit);
    }
}
