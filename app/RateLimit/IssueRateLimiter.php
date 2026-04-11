<?php

namespace App\RateLimit;

use App\Domain\Config;
use App\Domain\RateLimit;
use App\Domain\RateLimit\Action\LimitRateAction;
use Illuminate\Http\Request;

class IssueRateLimiter
{
    public function __construct(private Request $request, private LimitRateAction $limitRate) {}

    public function flooded(int $userId): bool
    {
        if (Config::IssueFloodInterval->get() <= 0) {
            return false;
        }

        $limit = RateLimit::IssueFlood
            ->get()
            ->by("issue.flood:{$userId}");

        return $this->limitRate->execute($limit);
    }

    public function tooManyAttempts(int $userId): bool
    {
        return $this->ipExceeded()
            || $this->userExceeded($userId);
    }

    private function ipExceeded(): bool
    {
        $limit = RateLimit::IssueByIp
            ->get()
            ->by("issue.ip:{$this->request->ip()}");

        return $this->limitRate->execute($limit);
    }

    private function userExceeded(int $userId): bool
    {
        $limit = RateLimit::IssueByUser
            ->get()
            ->by("issue.user:{$userId}");

        return $this->limitRate->execute($limit);
    }
}
