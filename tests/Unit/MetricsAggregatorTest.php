<?php namespace Tests\Unit;

use App\Domain\MetricsAggregator;
use App\Events\Stats\TripViewed;
use App\Events\Stats\UserAvatarUploaded;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MetricsAggregatorTest extends TestCase
{
    use DatabaseTransactions;

    public function testExport()
    {
        $metric1 = 'CrazyTestMetric1';
        $metric2 = 'FlagOfSuccessfulExport2';

        $aggregator = \Mockery::mock(MetricsAggregator::class)->makePartial();
        $aggregator->shouldReceive('eventClassExists')->andReturnTrue();
        $aggregator->push($metric1);
        $aggregator->push($metric1);
        $aggregator->push($metric2);
        $aggregator->export();

        $this->assertEquals([
            $metric1 => 0,
            $metric2 => 0,
        ], $aggregator->data());

        $this->assertDatabaseHas('metrics', [
            'date' => CarbonImmutable::now()->toDateString(),
            'event' => $metric1,
            'count' => 2,
        ]);

        $this->assertDatabaseHas('metrics', [
            'date' => CarbonImmutable::now()->toDateString(),
            'event' => $metric2,
            'count' => 1,
        ]);
    }

    public function testPush()
    {
        $event1 = class_basename(TripViewed::class);
        $event2 = class_basename(UserAvatarUploaded::class);

        $aggregator = new MetricsAggregator;
        $aggregator->push($event1);
        $aggregator->push($event1);
        $aggregator->push($event2);

        $this->assertEquals([
            $event1 => 2,
            $event2 => 1
        ], $aggregator->data());
    }
}
