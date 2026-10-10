<?php

namespace Tests\Feature;

use App\Console\Commands\MetricRename;
use App\Domain\Metrics\Factory\MetricFactory;
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

        MetricFactory::new()
            ->withDate('2025-06-15')
            ->withEvent($from)
            ->withCount(1)
            ->create();

        $this->artisan(MetricRename::class, ['from' => $from, 'to' => 'MaliciousMetric"); DROP TABLE metrics;--'])
            ->assertFailed()
            ->expectsOutputToContain('Unknown target metric');

        $this->assertDatabaseHas('metrics', ['event' => $from, 'count' => 1]);
    }

    public function testMergesCountsWhenDestinationEventAlreadyHasSameDate(): void
    {
        $from = 'DeletedEvent';
        $to = class_basename(HiraganaSelected::class);

        MetricFactory::new()
            ->withDate('2025-06-15')
            ->withEvent($from)
            ->withCount(3)
            ->create();

        MetricFactory::new()
            ->withDate('2025-06-15')
            ->withEvent($to)
            ->withCount(2)
            ->create();

        $this->artisan(MetricRename::class, ['from' => $from, 'to' => $to])
            ->assertSuccessful();

        $this->assertDatabaseMissing('metrics', ['event' => $from]);
        $this->assertDatabaseHas('metrics', ['event' => $to, 'date' => '2025-06-15', 'count' => 5]);
    }

    public function testRenamesMetricFromStaleEventToExistingOne(): void
    {
        $to = class_basename(HiraganaSelected::class);

        MetricFactory::new()
            ->withDate('2025-06-15')
            ->withEvent('DeletedEvent')
            ->withCount(5)
            ->create();

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

        MetricFactory::new()
            ->withDate('2025-06-15')
            ->withEvent($from)
            ->withCount(4)
            ->create();

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
