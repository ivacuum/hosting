<?php

namespace App\Domain\Metrics\Action;

use App\Domain\Metrics\RedisKey;
use Illuminate\Support\Facades\Redis;
use Predis\Command\RawCommand;

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
                logs()->debug(json_encode($metric, JSON_THROW_ON_ERROR));
            }
        }

        // RawCommand сохраняет ключ без префикса, executeCommand применяет `max_retries`
        Redis::client()->executeCommand(new RawCommand('XADD', [
            RedisKey::Metrics->value,
            '*',
            'json',
            json_encode($metrics, JSON_THROW_ON_ERROR),
        ]));
    }
}
