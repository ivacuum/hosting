<?php namespace App\Domain\Metrics\Action;

use App\Domain\Metrics\RedisKey;
use Illuminate\Support\Facades\Redis;

class ExportMetricsAction
{
    private bool $shouldLog;

    public function __construct()
    {
        $this->shouldLog = \App::isLocal();
    }

    public function execute(array $metrics): void
    {
        if (empty($metrics)) {
            return;
        }

        if ($this->shouldLog) {
            foreach ($metrics as $metric) {
                \Log::debug(json_encode($metric, JSON_THROW_ON_ERROR));
            }
        }

        Redis::client()->executeRaw(['XADD', RedisKey::Metrics->value, '*', 'json', json_encode($metrics, JSON_THROW_ON_ERROR)]);
    }
}
