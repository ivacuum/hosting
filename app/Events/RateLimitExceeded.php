<?php

namespace App\Events;

readonly class RateLimitExceeded
{
    public function __construct(
        public string $key,
        public string $maxAttempts
    ) {
    }
}
