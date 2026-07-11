<?php

namespace Tests\Feature;

use App\Console\Commands\MetricRename;
use App\Domain\Metrics\Models\Metric;
use App\Events\Stats\Build;
use App\Events\Stats\HiraganaSelected;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MetricRenameTest extends TestCase
{
    use DatabaseTransactions;

    public function testFailsWhenToMetricIsNotInPossibleMetrics(): void
    {
        $from = 'DeletedEvent';

        $metric = new Metric;
        $metric->date = '2025-06-15';
        $metric->event = $from;
        $metric->count = 1;
        $metric->save();

        $this->artisan(MetricRename::class, ['from' => $from, 'to' => 'MaliciousMetric"); DROP TABLE metrics;--'])
            ->assertFailed()
            ->expectsOutputToContain('Unknown target metric');

        $this->assertDatabaseHas('metrics', ['event' => $from, 'count' => 1]);
    }

    public function testMergesCountsWhenDestinationEventAlreadyHasSameDate(): void
    {
        $from = 'DeletedEvent';
        $to = class_basename(HiraganaSelected::class);

        $metric = new Metric;
        $metric->date = '2025-06-15';
        $metric->event = $from;
        $metric->count = 3;
        $metric->save();

        $metric = new Metric;
        $metric->date = '2025-06-15';
        $metric->event = $to;
        $metric->count = 2;
        $metric->save();

        $this->artisan(MetricRename::class, ['from' => $from, 'to' => $to])
            ->assertSuccessful();

        $this->assertDatabaseMissing('metrics', ['event' => $from]);
        $this->assertDatabaseHas('metrics', ['event' => $to, 'date' => '2025-06-15', 'count' => 5]);
    }

    public function testRenamesMetricFromStaleEventToExistingOne(): void
    {
        $to = class_basename(HiraganaSelected::class);

        $metric = new Metric;
        $metric->date = '2025-06-15';
        $metric->event = 'DeletedEvent';
        $metric->count = 5;
        $metric->save();

        $this->artisan(MetricRename::class, ['from' => 'DeletedEvent', 'to' => $to])
            ->assertSuccessful()
            ->expectsOutputToContain("Renamed DeletedEvent => {$to} (rows: 1)");

        $this->assertDatabaseMissing('metrics', ['event' => 'DeletedEvent']);
        $this->assertDatabaseHas('metrics', ['event' => $to, 'date' => '2025-06-15', 'count' => 5]);
    }

    public function testSucceedsWhenFromIsAValidExistingMetric(): void
    {
        $from = class_basename(Build::class);
        $to = class_basename(HiraganaSelected::class);

        $metric = new Metric;
        $metric->date = '2025-06-15';
        $metric->event = $from;
        $metric->count = 4;
        $metric->save();

        $this->artisan(MetricRename::class, ['from' => $from, 'to' => $to])
            ->assertSuccessful();

        $this->assertDatabaseMissing('metrics', ['event' => $from]);
        $this->assertDatabaseHas('metrics', ['event' => $to, 'date' => '2025-06-15', 'count' => 4]);
    }

    public function testSucceedsWithNoRowsToRename(): void
    {
        $from = 'AlreadyGone';
        $to = class_basename(HiraganaSelected::class);

        $this->artisan(MetricRename::class, ['from' => $from, 'to' => $to])
            ->assertSuccessful()
            ->expectsOutputToContain("No metrics found for [{$from}]");

        $this->assertDatabaseMissing('metrics', ['event' => $from]);
    }
}
