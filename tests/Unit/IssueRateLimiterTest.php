<?php

namespace Tests\Unit;

use App\Domain\RateLimit\Events\RateLimitExceeded;
use App\Factory\UserFactory;
use App\RateLimit\IssueRateLimiter;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class IssueRateLimiterTest extends TestCase
{
    use DatabaseTransactions;

    public function testFlooded()
    {
        Event::fake(RateLimitExceeded::class);

        $user = UserFactory::new()->create();

        config(['cfg.limits.issue.flood_interval' => 10]);

        $limiter = app(IssueRateLimiter::class);

        $this->assertFalse($limiter->flooded($user->id));
        Event::assertNotDispatched(RateLimitExceeded::class);

        $this->assertTrue($limiter->flooded($user->id));
        Event::assertDispatched(RateLimitExceeded::class);
    }

    public function testFloodedDisabled()
    {
        Event::fake(RateLimitExceeded::class);

        $user = UserFactory::new()->create();

        config(['cfg.limits.issue.flood_interval' => 0]);

        $limiter = app(IssueRateLimiter::class);

        $this->assertFalse($limiter->flooded($user->id));
        $this->assertFalse($limiter->flooded($user->id));

        Event::assertNotDispatched(RateLimitExceeded::class);
    }

    public function testIpExceeded()
    {
        Event::fake(RateLimitExceeded::class);

        $user = UserFactory::new()->create();

        config(['cfg.limits.issue.ip' => 1]);
        config(['cfg.limits.issue.user' => 0]);

        $limiter = app(IssueRateLimiter::class);

        $this->assertFalse($limiter->tooManyAttempts($user->id));
        $this->assertTrue($limiter->tooManyAttempts($user->id));

        Event::assertDispatched(RateLimitExceeded::class);
    }

    public function testUserExceeded()
    {
        Event::fake(RateLimitExceeded::class);

        $user = UserFactory::new()->create();

        config(['cfg.limits.issue.ip' => 0]);
        config(['cfg.limits.issue.user' => 1]);

        $limiter = app(IssueRateLimiter::class);

        $this->assertFalse($limiter->tooManyAttempts($user->id));
        $this->assertTrue($limiter->tooManyAttempts($user->id));

        Event::assertDispatched(RateLimitExceeded::class);
    }
}
