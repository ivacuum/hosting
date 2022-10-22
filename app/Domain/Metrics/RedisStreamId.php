<?php namespace App\Domain\Metrics;

enum RedisStreamId: string
{
    case FromTheStart = '0';
    case OnlyNew = '$';
}
