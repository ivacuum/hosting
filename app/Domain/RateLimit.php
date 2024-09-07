<?php

namespace App\Domain;

use Illuminate\Cache\RateLimiting\Limit;

enum RateLimit
{
    case CommentByIp;
    case CommentByUser;
    case IssueByIp;
    case IssueByUser;
    case MagnetGlobal;

    public function get()
    {
        return match ($this) {
            self::CommentByIp => Limit::perDay(config()->integer('cfg.limits.comment.ip')),
            self::CommentByUser => Limit::perDay(config()->integer('cfg.limits.comment.user')),
            self::IssueByIp => Limit::perDay(config()->integer('cfg.limits.issue.ip')),
            self::IssueByUser => Limit::perDay(config()->integer('cfg.limits.issue.user')),
            self::MagnetGlobal => Limit::perDay(config()->integer('cfg.limits.magnet.per_day')),
        };
    }
}
