<?php

namespace App\Console\Commands;

use App\Action\HandleMetricPayloadAction;
use App\Domain\CacheKey;
use App\Domain\ImageViewsAggregator;
use App\Domain\Life\PhotoViewsAggregator;
use App\Domain\Metrics\Action\FetchMetricsAction;
use App\Domain\Metrics\RedisStreamId;
use App\Domain\MetricsAggregator;
use App\Domain\ViewsAggregator;
use Illuminate\Cache\Repository;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Support\Facades\DB;

#[Signature('app:metrics:process')]
#[Description('Process metrics from redis stream and push them to database')]
class ProcessMetrics extends Command
{
    public function handle(
        Repository $cache,
        FetchMetricsAction $fetchMetrics,
        HandleMetricPayloadAction $handleMetricPayload,
        MetricsAggregator $metricsAggregator,
        ViewsAggregator $viewsAggregator,
        ImageViewsAggregator $imageViewsAggregator,
        PhotoViewsAggregator $photoViewsAggregator,
    ) {
        $nextStartId = $cache->get(CacheKey::MetricsNextStartId) ?? RedisStreamId::FromTheStart->value;

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
                    ->map(static fn ($value, $key) => [$key, $value])
                    ->all(),
            );
        }

        DB::beginTransaction();

        try {
            $metricsAggregator->export();
            $viewsAggregator->export();
            $imageViewsAggregator->export();
            $photoViewsAggregator->export();

            DB::commit();
        } catch (\Throwable $e) {
            report($e);
            DB::rollBack();

            $this->error('Export failed, cursor not advanced. See logs.');

            return;
        }

        $cache->put(CacheKey::MetricsNextStartId, $nextStartId, CacheKey::MetricsNextStartId->ttl());

        $this->line("Processed metric stream entries: <info>{$processed}</info>");
    }
}
