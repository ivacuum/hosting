<?php

namespace App\Domain;

use Illuminate\Cache\RateLimiting\Limit;

enum RateLimit
{
    case CommentByIp;
    case CommentByUser;
    case CommentFlood;
    case ExifReader;
    case IssueByIp;
    case IssueByUser;
    case IssueFlood;
    case MagnetGlobal;

    public function get(): Limit
    {
        return match ($this) {
            self::CommentByIp => Limit::perDay(config()->integer('cfg.limits.comment.ip')),
            self::CommentByUser => Limit::perDay(config()->integer('cfg.limits.comment.user')),
            self::CommentFlood => new Limit('', 1, config()->integer('cfg.limits.comment.flood_interval')),
            self::ExifReader => Limit::perHour(config()->integer('cfg.limits.exif-reader.per_hour')),
            self::IssueByIp => Limit::perDay(config()->integer('cfg.limits.issue.ip')),
            self::IssueByUser => Limit::perDay(config()->integer('cfg.limits.issue.user')),
            self::IssueFlood => new Limit('', 1, config()->integer('cfg.limits.issue.flood_interval')),
            self::MagnetGlobal => Limit::perDay(config()->integer('cfg.limits.magnet.per_day')),
        };
    }
}
