<?php

namespace App\Domain\Log;

enum HttpFailureCategory: string
{
    case Connection = 'connection';
    case Dns = 'dns';
    case Timeout = 'timeout';
    case Tls = 'tls';
    case Transport = 'transport';

    public static function fromCurlErrno(int|null $errno): self
    {
        return match ($errno) {
            5, 6 => self::Dns,
            7 => self::Connection,
            28 => self::Timeout,
            35, 51, 58, 60, 77, 80, 82, 83, 90, 91 => self::Tls,
            default => self::Transport,
        };
    }
}
