<?php namespace App\Events;

class RateLimitExceeded
{
    public function __construct(
        public readonly string $key,
        public readonly string $maxAttempts
    ) {
    }
}
