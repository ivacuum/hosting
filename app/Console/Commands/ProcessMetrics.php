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
    ): int {
        $startId = $cache->get(CacheKey::MetricsNextStartId) ?? RedisStreamId::FromTheStart->value;
        $nextStartId = $startId;

        $metrics = $fetchMetrics->execute($startId);
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

        if ($processed === 0) {
            return self::SUCCESS;
        }

        $context = [
            'stream_entries' => $processed,
            'metrics' => collect($metricsAggregator->data())->filter()->all(),
            'start_id' => $startId,
            'next_start_id' => $nextStartId,
        ];

        try {
            DB::transaction(static function () use (
                $metricsAggregator,
                $viewsAggregator,
                $imageViewsAggregator,
                $photoViewsAggregator,
            ): void {
                $metricsAggregator->export();
                $viewsAggregator->export();
                $imageViewsAggregator->export();
                $photoViewsAggregator->export();
            });
        } catch (\Throwable $e) {
            report($e);

            return self::FAILURE;
        }

        $cache->put(CacheKey::MetricsNextStartId, $nextStartId, CacheKey::MetricsNextStartId->ttl());

        logs()->info('metrics.processed', $context);

        return self::SUCCESS;
    }
}
