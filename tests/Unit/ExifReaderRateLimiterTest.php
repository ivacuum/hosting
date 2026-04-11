<?php

namespace Tests\Unit;

use App\Domain\Exif\RateLimit\ExifReaderRateLimiter;
use App\Domain\RateLimit\Events\RateLimitExceeded;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ExifReaderRateLimiterTest extends TestCase
{
    use DatabaseTransactions;

    public function testGlobalLimitExceeded()
    {
        Event::fake(RateLimitExceeded::class);

        config(['cfg.limits.exif-reader.per_hour' => 1]);

        $rateLimiter = app(ExifReaderRateLimiter::class);

        $this->assertFalse($rateLimiter->tooManyAttempts());
        $this->assertTrue($rateLimiter->tooManyAttempts());

        Event::assertDispatched(RateLimitExceeded::class);
    }
}
