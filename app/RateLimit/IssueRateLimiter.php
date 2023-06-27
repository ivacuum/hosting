<?php

namespace App\RateLimit;

use App\Action\LimitRateAction;
use App\Issue;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Ivacuum\Generic\Events\LimitExceeded;

class IssueRateLimiter
{
    public function __construct(private Request $request, private LimitRateAction $limitRate)
    {
    }

    public function flooded(int $userId): bool
    {
        $interval = config('cfg.limits.issue.flood_interval');

        if ($interval <= 0) {
            return false;
        }

        /** @var Issue $last */
        $last = Issue::query()
            ->where('user_id', $userId)
            ->orderByDesc('id')
            ->first(['created_at']);

        if ($last === null) {
            return false;
        }

        $diff = now()->diffInSeconds($last->created_at);

        if ($diff < $interval) {
            event(new LimitExceeded('issue.flood_interval', $userId));

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
        $limit = Limit::perDay(config('cfg.limits.issue.ip'))
            ->by("issue.ip:{$this->request->ip()}");

        return $this->limitRate->execute($limit);
    }

    private function userExceeded(int $userId): bool
    {
        $limit = Limit::perDay(config('cfg.limits.issue.user'))
            ->by("issue.user:{$userId}");

        return $this->limitRate->execute($limit);
    }
}
