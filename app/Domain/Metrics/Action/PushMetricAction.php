<?php

namespace App\Domain\Metrics\Action;

class PushMetricAction
{
    private bool $shouldExportImmediately;
    private array $metrics = [];

    public function __construct(private ExportMetricsAction $exportMetrics)
    {
        $this->shouldExportImmediately = \App::runningInConsole();

        $this->setupExport();
    }

    public function execute(array $data): void
    {
        $this->metrics[] = $data;

        if ($this->shouldExportImmediately) {
            $this->export();
        }
    }

    private function export(): void
    {
        $this->exportMetrics->execute($this->metrics);
        $this->resetMetrics();
    }

    private function isLocalOrProduction(): bool
    {
        return \App::isLocal()
            || \App::isProduction();
    }

    private function resetMetrics(): void
    {
        $this->metrics = [];
    }

    private function setupExport(): void
    {
        if (!$this->isLocalOrProduction()) {
            return;
        }

        if ($this->shouldExportImmediately) {
            return;
        }

        register_shutdown_function(function () {
            $this->export();
        });
    }
}
