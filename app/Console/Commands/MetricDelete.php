<?php

namespace App\Console\Commands;

use App\Domain\Metrics\Models\Metric;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;

#[Signature('app:metric-delete {metric}')]
#[Description('Delete a metric')]
class MetricDelete extends Command
{
    public function handle(): void
    {
        $metric = $this->argument('metric');

        $count = Metric::query()->where('event', $metric)->delete();

        $this->info("Deleted {$metric} (rows: {$count})");
    }
}
