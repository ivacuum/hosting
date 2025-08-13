<?php

namespace App\Domain\Exif\RateLimit;

use App\Action\LimitRateAction;
use App\Domain\RateLimit;

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
