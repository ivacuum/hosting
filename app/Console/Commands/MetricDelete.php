<?php

namespace App\Console\Commands;

use App\Domain\Metrics\Models\Metric;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:metric-delete')]
class MetricDelete extends Command
{
    protected $signature = 'app:metric-delete {metric}';
    protected $description = 'Delete a metric';

    public function handle()
    {
        $metric = $this->argument('metric');

        $count = Metric::query()->where('event', $metric)->count();

        Metric::query()->where('event', $metric)->delete();

        $this->info("Deleted {$metric} (rows: {$count})");
    }
}
