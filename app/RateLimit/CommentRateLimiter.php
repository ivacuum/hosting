<?php

namespace App\RateLimit;

use App\Action\LimitRateAction;
use App\Comment;
use App\Domain\Config;
use App\Domain\RateLimit;
use Illuminate\Http\Request;

class CommentRateLimiter
{
    public function __construct(private Request $request, private LimitRateAction $limitRate) {}

    public function flooded(int $userId): bool
    {
        $interval = Config::CommentFloodInterval->get();

        if ($interval <= 0) {
            return false;
        }

        /** @var Comment $last */
        $last = Comment::query()
            ->where('user_id', $userId)
            ->orderByDesc('id')
            ->first(['created_at']);

        if ($last === null) {
            return false;
        }

        $diff = now()->diffInSeconds($last->created_at, true);

        if ($diff < $interval) {
            return true;
        }

        return false;
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
