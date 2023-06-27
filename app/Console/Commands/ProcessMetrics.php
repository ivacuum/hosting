<?php

namespace App\Console\Commands;

use App\Action\HandleMetricPayloadAction;
use App\Domain\CacheKey;
use App\Domain\ImageViewsAggregator;
use App\Domain\Metrics\Action\FetchMetricsAction;
use App\Domain\Metrics\RedisStreamId;
use App\Domain\MetricsAggregator;
use App\Domain\PhotoViewsAggregator;
use App\Domain\ViewsAggregator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProcessMetrics extends Command
{
    protected $signature = 'app:metrics:process';
    protected $description = 'Process metrics from redis stream and push them to database';

    public function handle(
        FetchMetricsAction $fetchMetrics,
        HandleMetricPayloadAction $handleMetricPayload,
        MetricsAggregator $metricsAggregator,
        ViewsAggregator $viewsAggregator,
        ImageViewsAggregator $imageViewsAggregator,
        PhotoViewsAggregator $photoViewsAggregator,
    ) {
        $nextStartId = \Cache::get(CacheKey::MetricsNextStartId->value) ?? RedisStreamId::FromTheStart->value;

        $this->line("Processing metrics from id: <info>{$nextStartId}</info>");

        $metrics = $fetchMetrics->execute($nextStartId);
        $processed = 0;

        foreach ($metrics as $key => $json) {
            $handleMetricPayload->execute(
                json_decode($json, true, flags: JSON_THROW_ON_ERROR),
                $metricsAggregator,
                $viewsAggregator,
                $imageViewsAggregator,
                $photoViewsAggregator,
            );

            $nextStartId = $key;
            $processed++;
        }

        if ($processed) {
            $this->table(
                ['Metric', 'Value'],
                collect($metricsAggregator->data())
                    ->filter()
                    ->map(fn ($value, $key) => [$key, $value])
                    ->all(),
            );
        }

        DB::beginTransaction();

        try {
            $metricsAggregator->export();
            $viewsAggregator->export();
            $imageViewsAggregator->export();
            $photoViewsAggregator->export();

            \Cache::put(CacheKey::MetricsNextStartId->value, $nextStartId, CacheKey::MetricsNextStartId->ttl());

            DB::commit();
        } catch (\Throwable $e) {
            report($e);

            DB::rollBack();
        }

        $this->line("Processed metric stream entries: <info>{$processed}</info>");
    }
}
