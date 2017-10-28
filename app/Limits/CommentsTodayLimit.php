<?php namespace App\Limits;

use App\Activity;
use Ivacuum\Generic\Events\LimitExceeded;

class CommentsTodayLimit
{
    public function flood(int $user_id): bool
    {
        $interval = config('cfg.limits.comment.flood_interval');

        if ($interval <= 0) {
            return false;
        }

        $last = Activity::where('user_id', $user_id)
            ->where('type', 'Comment.created')
            ->orderBy('id', 'desc')
            ->first(['created_at']);

        if (is_null($last)) {
            return false;
        }

        $diff = now()->diffInSeconds($last->created_at);

        if ($diff < $interval) {
            event(new LimitExceeded('comment.flood_interval', $user_id));

            return true;
        }

        return false;
    }

    public function ipExceeded(): bool
    {
        $ip = request()->ip();
        $limit = config('cfg.limits.comment.ip');

        $count = Activity::where('type', 'Comment.created')
            ->where('ip', $ip)
            ->where('created_at', '>', now()->startOfDay())
            ->count();

        if ($count >= $limit) {
            event(new LimitExceeded('comment.ip', $ip));

            return true;
        }

        return false;
    }

    public function userExceeded(int $user_id): bool
    {
        $limit = config('cfg.limits.comment.user');

        $count = Activity::where('type', 'Comment.created')
            ->where('user_id', $user_id)
            ->where('created_at', '>', now()->startOfDay())
            ->count();

        if ($count >= $limit) {
            event(new LimitExceeded('comment.user', $user_id));

            return true;
        }

        return false;
    }
}
