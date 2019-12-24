<?php namespace App\Limits;

use App\Activity;
use Ivacuum\Generic\Events\LimitExceeded;

class IssuesTodayLimit
{
    public function flood(int $userId): bool
    {
        $interval = config('cfg.limits.issue.flood_interval');

        if ($interval <= 0) {
            return false;
        }

        $last = Activity::where('user_id', $userId)
            ->where('type', 'Issue.created')
            ->orderByDesc('id')
            ->first(['created_at']);

        if (null === $last) {
            return false;
        }

        $diff = now()->diffInSeconds($last->created_at);

        if ($diff < $interval) {
            event(new LimitExceeded('issue.flood_interval', $userId));

            return true;
        }

        return false;
    }

    public function ipExceeded(): bool
    {
        $ip = request()->ip();
        $limit = config('cfg.limits.issue.ip');

        $count = Activity::where('type', 'Issue.created')
            ->where('ip', $ip)
            ->where('created_at', '>', now()->startOfDay())
            ->count();

        if ($count >= $limit) {
            event(new LimitExceeded('issue.ip', $ip));

            return true;
        }

        return false;
    }

    public function userExceeded(int $userId): bool
    {
        $limit = config('cfg.limits.issue.user');

        $count = Activity::where('type', 'Issue.created')
            ->where('user_id', $userId)
            ->where('created_at', '>', now()->startOfDay())
            ->count();

        if ($count >= $limit) {
            event(new LimitExceeded('issue.user', $userId));

            return true;
        }

        return false;
    }
}
