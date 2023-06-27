<?php

namespace App\Seeder;

use App\Events\Stats\IssueAdded;
use App\Metric;
use Illuminate\Database\Seeder;

class MetricSeeder extends Seeder
{
    public function run()
    {
        $metric = new Metric();
        $metric->date = now();
        $metric->count = 4;
        $metric->event = class_basename(IssueAdded::class);
        $metric->save();
    }
}
