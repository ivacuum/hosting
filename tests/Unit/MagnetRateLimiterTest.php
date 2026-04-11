<?php

namespace Tests\Unit;

use App\Domain\Magnet\RateLimit\MagnetRateLimiter;
use App\Domain\RateLimit\Events\RateLimitExceeded;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class MagnetRateLimiterTest extends TestCase
{
    use DatabaseTransactions;

    public function testGlobalLimitExceeded()
    {
        Event::fake(RateLimitExceeded::class);

        config(['cfg.limits.magnet.per_day' => 1]);

        $limiter = app(MagnetRateLimiter::class);

        $this->assertFalse($limiter->tooManyAttempts());
        $this->assertTrue($limiter->tooManyAttempts());

        Event::assertDispatched(RateLimitExceeded::class);
    }
}
