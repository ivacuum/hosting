<?php

namespace Tests\Unit;

use App\Factory\UserFactory;
use App\RateLimit\CommentRateLimiter;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommentRateLimiterTest extends TestCase
{
    use DatabaseTransactions;

    public function testIpExceeded()
    {
        $user = UserFactory::new()->create();

        config(['cfg.limits.comment.ip' => 1]);
        config(['cfg.limits.comment.user' => 0]);

        $limiter = app(CommentRateLimiter::class);

        $this->assertFalse($limiter->tooManyAttempts($user->id));
        $this->assertTrue($limiter->tooManyAttempts($user->id));
    }

    public function testUserExceeded()
    {
        $user = UserFactory::new()->create();

        config(['cfg.limits.comment.ip' => 0]);
        config(['cfg.limits.comment.user' => 1]);

        $limiter = app(CommentRateLimiter::class);

        $this->assertFalse($limiter->tooManyAttempts($user->id));
        $this->assertTrue($limiter->tooManyAttempts($user->id));
    }
}
