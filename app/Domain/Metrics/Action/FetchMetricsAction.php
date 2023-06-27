<?php

namespace App\Domain\Metrics\Action;

use App\Domain\Metrics\RedisKey;
use App\Domain\Metrics\RedisReadStreamCommandFactory;
use App\Domain\Metrics\RedisStream;
use App\Domain\Metrics\RedisStreamId;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;

class FetchMetricsAction
{
    public function execute(RedisStreamId|string $startId = RedisStreamId::FromTheStart): Collection
    {
        $readStreamCommand = RedisReadStreamCommandFactory::new()
            ->withCount(999)
            ->withStreams(new RedisStream(RedisKey::Metrics, $startId));

        $response = Redis::client()
            ->executeRaw($readStreamCommand->make());

        if ($response === null) {
            return collect();
        }

        return collect($response[0][1])
            ->mapWithKeys(fn ($value) => [$value[0] => $value[1][1]]);
    }
}
