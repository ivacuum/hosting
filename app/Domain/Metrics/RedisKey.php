<?php namespace App\Domain\Metrics;

enum RedisKey: string
{
    case Metrics = 'vacuum:metrics';
}
