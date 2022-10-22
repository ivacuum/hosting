<?php namespace App\Domain\Metrics\Action;

use App\Domain\Metrics\RedisKey;
use Illuminate\Support\Facades\Redis;

class TrimMetricsStreamAction
{
    public function execute(): int
    {
        return Redis::client()
            ->executeRaw(['XTRIM', RedisKey::Metrics->value, 'MAXLEN', '~', '5000']);
    }
}
