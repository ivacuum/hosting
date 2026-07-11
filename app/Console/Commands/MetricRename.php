<?php

namespace App\Console\Commands;

use App\Action\IfMetricExistsAction;
use App\Domain\Metrics\Models\Metric;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;

#[Signature('app:metric-rename {from} {to}')]
#[Description('Rename a metric')]
class MetricRename extends Command
{
    public function handle(IfMetricExistsAction $metricExists): int
    {
        $to = $this->argument('to');
        $from = $this->argument('from');

        if (!$metricExists->execute($to)) {
            $this->error("Unknown target metric [{$to}]. Must be one of: " . implode(', ', Metric::possibleMetrics()));

            return self::FAILURE;
        }

        $rows = Metric::query()
            ->where('event', $from)
            ->count();

        if ($rows === 0) {
            $this->info("No metrics found for [{$from}]");

            return self::SUCCESS;
        }

        \DB::transaction(function () use ($to, $from): void {
            \DB::statement(
                'INSERT INTO metrics (`date`, `event`, `count`) SELECT src.`date`, ?, src.`count` FROM metrics AS src WHERE src.event = ? ON DUPLICATE KEY UPDATE metrics.`count` = metrics.`count` + VALUES(`count`)',
                [$to, $from],
            );

            Metric::query()
                ->where('event', $from)
                ->delete();
        });

        $this->info("Renamed {$from} => {$to} (rows: {$rows})");

        return self::SUCCESS;
    }
}
