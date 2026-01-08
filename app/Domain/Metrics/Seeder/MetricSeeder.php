<?php

namespace App\Domain\Metrics\Seeder;

use App\Domain\Metrics\Models\Metric;
use App\Events\Stats\IssueAdded;
use Illuminate\Database\Seeder;

class MetricSeeder extends Seeder
{
    public function run()
    {
        $metric = new Metric;
        $metric->date = now();
        $metric->count = 4;
        $metric->event = class_basename(IssueAdded::class);
        $metric->save();
    }
}
