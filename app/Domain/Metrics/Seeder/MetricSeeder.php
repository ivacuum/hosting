<?php

namespace App\Domain\Metrics\Seeder;

use App\Domain\Metrics\Models\Metric;
use Illuminate\Database\Seeder;

class MetricSeeder extends Seeder
{
    public function run(): void
    {
        $event = 'IssueAdded';
        $current = now()->subYears(10)->startOfYear();
        $end = now();
        $rows = [];

        while ($current->lte($end)) {
            if (mt_rand(1, 100) > 5) {
                $rows[] = [
                    'date' => $current->toDateString(),
                    'event' => $event,
                    'count' => mt_rand(0, 50),
                ];
            }

            $current = $current->addDay();

            if (count($rows) >= 500) {
                Metric::upsert($rows, ['date', 'event'], ['count' => new \Illuminate\Database\Query\Expression('`count` + VALUES(`count`)')]);
                $rows = [];
            }
        }

        if ($rows !== []) {
            Metric::upsert($rows, ['date', 'event'], ['count' => new \Illuminate\Database\Query\Expression('`count` + VALUES(`count`)')]);
        }
    }
}
