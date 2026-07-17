<?php

namespace App\Domain\Metrics;

use Carbon\CarbonInterval;
use Illuminate\Support\Collection;

class RedisReadStreamCommandFactory
{
    /** @var array<\App\Domain\Metrics\RedisStream> */
    private array $streams = [];
    private int|null $count = null;
    private int|null $blockForMs = null;

    public function make()
    {
        $payload = collect(['XREAD'])
            ->when($this->count !== null, fn (Collection $collect) => $collect->push('COUNT', $this->count))
            ->when($this->blockForMs !== null, fn (Collection $collect) => $collect->push('BLOCK', $this->blockForMs))
            ->push('STREAMS');

        foreach ($this->streams as $stream) {
            $payload->push($stream->stream);
        }

        foreach ($this->streams as $stream) {
            $payload->push($stream->startId);
        }

        return $payload->all();
    }

    public static function new(): self
    {
        return new self;
    }

    public function withBlock(CarbonInterval $interval)
    {
        return clone ($this, ['blockForMs' => $interval->totalMilliseconds]);
    }

    public function withCount(int $count)
    {
        return clone ($this, ['count' => $count]);
    }

    public function withStreams(RedisStream ...$streams)
    {
        return clone ($this, ['streams' => $streams]);
    }
}
