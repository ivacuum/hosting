<?php

namespace App\Domain\Profiling;

use Illuminate\Container\Attributes\Config;
use Illuminate\Container\Attributes\Scoped;

#[Scoped]
class Profiler
{
    private \ExcimerProfiler|null $profiler = null;
    private \ExcimerLog|null $log = null;
    private float $startedAt = 0;
    private float|null $stoppedAt = null;

    public function __construct(
        private readonly PyroscopeExporter $exporter,
        #[Config('profiling.enabled')]
        private readonly bool $enabled,
        #[Config('profiling.sample_rate')]
        private readonly float $sampleRate,
        #[Config('profiling.frequency')]
        private readonly int $frequency,
        #[Config('profiling.max_samples')]
        private readonly int $maxSamples,
    ) {}

    /**
     * @param  array<string, string>  $labels
     */
    public function finish(array $labels): void
    {
        if ($this->profiler === null) {
            return;
        }

        $profiler = $this->profiler;
        $this->profiler = null;

        try {
            $profiler->stop();
            $profiler->clearFlushCallback();
            $stoppedAt = $this->stoppedAt ?? microtime(true);
            $body = ($this->log ?? $profiler->flush())->formatCollapsed();

            if ($body !== '') {
                $this->exporter->send($body, $this->startedAt, $stoppedAt, $labels, $this->frequency);
            }
        } catch (\Throwable $exception) {
            logs()->debug('profiling.finish_failed', ['exception' => $exception]);
        } finally {
            $this->log = null;
            $this->stoppedAt = null;
        }
    }

    public function start(): void
    {
        if ($this->profiler !== null
            || !$this->enabled
            || !extension_loaded('excimer')
            || $this->sampleRate <= 0
            || $this->sampleRate > 1
            || $this->frequency < 1
            || mt_rand() / (mt_getrandmax() + 1) >= $this->sampleRate) {
            return;
        }

        try {
            $this->profiler = new \ExcimerProfiler;
            $this->profiler->setEventType(EXCIMER_REAL);
            $this->profiler->setPeriod(1 / $this->frequency);
            $this->profiler->setMaxDepth(128);
            $this->profiler->setFlushCallback(function (\ExcimerLog $log): void {
                $this->profiler?->stop();
                $this->log = $log;
                $this->stoppedAt = microtime(true);
            }, max(1, $this->maxSamples));

            $this->startedAt = microtime(true);
            $this->profiler->start();
        } catch (\Throwable $exception) {
            $this->profiler?->stop();
            $this->profiler?->clearFlushCallback();
            $this->profiler = null;
            logs()->debug('profiling.start_failed', ['exception' => $exception]);
        }
    }
}
