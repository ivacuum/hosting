<?php namespace App\Domain\Metrics;

class RedisStream
{
    public readonly string $stream;
    public readonly string $startId;

    public function __construct(RedisKey|string $stream, RedisStreamId|string $startId)
    {
        $this->stream = match (true) {
            $stream instanceof RedisKey => $stream->value,
            default => $stream,
        };

        $this->startId = match (true) {
            $startId instanceof RedisStreamId => $startId->value,
            default => $startId,
        };
    }
}
