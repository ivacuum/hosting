<?php

namespace Tests\Unit;

use App\Domain\Exif\RateLimit\ExifReaderRateLimiter;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ExifReaderRateLimiterTest extends TestCase
{
    use DatabaseTransactions;

    public function testGlobalLimitExceeded()
    {
        config(['cfg.limits.exif-reader.per_hour' => 1]);

        $rateLimiter = app(ExifReaderRateLimiter::class);

        $this->assertFalse($rateLimiter->tooManyAttempts());
        $this->assertTrue($rateLimiter->tooManyAttempts());
    }
}
