<?php

namespace Tests\Unit;

use App\Domain\RateLimit\Events\RateLimitExceeded;
use App\Factory\UserFactory;
use App\RateLimit\CommentRateLimiter;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CommentRateLimiterTest extends TestCase
{
    use DatabaseTransactions;

    public function testFlooded(): void
    {
        Event::fake(RateLimitExceeded::class);

        $user = UserFactory::new()->create();

        config(['cfg.limits.comment.flood_interval' => 10]);

        $limiter = app(CommentRateLimiter::class);

        $this->assertFalse($limiter->flooded($user->id));
        $this->assertTrue($limiter->flooded($user->id));

        Event::assertDispatched(RateLimitExceeded::class);
    }

    public function testFloodedDisabled(): void
    {
        Event::fake(RateLimitExceeded::class);

        $user = UserFactory::new()->create();

        config(['cfg.limits.comment.flood_interval' => 0]);

        $limiter = app(CommentRateLimiter::class);

        $this->assertFalse($limiter->flooded($user->id));
        $this->assertFalse($limiter->flooded($user->id));

        Event::assertNotDispatched(RateLimitExceeded::class);
    }

    public function testIpExceeded(): void
    {
        Event::fake(RateLimitExceeded::class);

        $user = UserFactory::new()->create();

        config(['cfg.limits.comment.ip' => 1]);
        config(['cfg.limits.comment.user' => 0]);

        $limiter = app(CommentRateLimiter::class);

        $this->assertFalse($limiter->tooManyAttempts($user->id));
        $this->assertTrue($limiter->tooManyAttempts($user->id));

        Event::assertDispatched(RateLimitExceeded::class);
    }

    public function testUserExceeded(): void
    {
        Event::fake(RateLimitExceeded::class);

        $user = UserFactory::new()->create();

        config(['cfg.limits.comment.ip' => 0]);
        config(['cfg.limits.comment.user' => 1]);

        $limiter = app(CommentRateLimiter::class);

        $this->assertFalse($limiter->tooManyAttempts($user->id));
        $this->assertTrue($limiter->tooManyAttempts($user->id));

        Event::assertDispatched(RateLimitExceeded::class);
    }
}
