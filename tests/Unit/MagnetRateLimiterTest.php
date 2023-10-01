<?php

namespace Tests\Unit;

use App\RateLimit\MagnetRateLimiter;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MagnetRateLimiterTest extends TestCase
{
    use DatabaseTransactions;

    public function testGlobalLimitExceeded()
    {
        config(['cfg.limits.magnet.per_day' => 1]);

        $limiter = app(MagnetRateLimiter::class);

        $this->assertFalse($limiter->tooManyAttempts());
        $this->assertTrue($limiter->tooManyAttempts());
    }
}
