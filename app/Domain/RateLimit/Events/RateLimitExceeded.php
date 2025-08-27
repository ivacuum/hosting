<?php

namespace App\Domain\RateLimit\Events;

readonly class RateLimitExceeded
{
    public function __construct(
        public string $key,
        public string $maxAttempts,
    ) {}
}
