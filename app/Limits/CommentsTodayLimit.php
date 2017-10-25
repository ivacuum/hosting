<?php namespace App\Limits;

use App\Activity;
use Ivacuum\Generic\Contracts\Limit;
use Ivacuum\Generic\Events\LimitExceeded;

class CommentsTodayLimit implements Limit
{
    public function __construct()
    {
        if (auth()->guest()) {
            throw new \Exception('Для гостя лимиты не предусмотрены');
        }
    }

    public function floodControl(): bool
    {
        $user_id = auth()->id();
        $interval = config('cfg.limits.comment.flood_interval');

        if ($interval <= 0) {
            return false;
        }

        $created_at = Activity::where('user_id', $user_id)
            ->where('type', 'Comment.created')
            ->orderBy('id', 'desc')
            ->first(['created_at'])
            ->created_at;

        $diff = now()->diffInSeconds($created_at);

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

    public function userExceeded(): bool
    {
        $limit = config('cfg.limits.comment.user');
        $user_id = auth()->id();

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
