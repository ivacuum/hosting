<?php

namespace App\RateLimit;

use App\Domain\Config;
use App\Domain\RateLimit;
use App\Domain\RateLimit\Action\LimitRateAction;
use Illuminate\Http\Request;

class CommentRateLimiter
{
    public function __construct(private Request $request, private LimitRateAction $limitRate) {}

    public function flooded(int $userId): bool
    {
        if (Config::CommentFloodInterval->get() <= 0) {
            return false;
        }

        $limit = RateLimit::CommentFlood
            ->get()
            ->by("comment.flood:{$userId}");

        return $this->limitRate->execute($limit);
    }

    public function tooManyAttempts(int $userId): bool
    {
        return $this->ipExceeded()
            || $this->userExceeded($userId);
    }

    private function ipExceeded(): bool
    {
        $limit = RateLimit::CommentByIp
            ->get()
            ->by("comment.ip:{$this->request->ip()}");

        return $this->limitRate->execute($limit);
    }

    private function userExceeded(int $userId): bool
    {
        $limit = RateLimit::CommentByUser
            ->get()
            ->by("comment.user:{$userId}");

        return $this->limitRate->execute($limit);
    }
}
