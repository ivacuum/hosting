<?php

namespace Tests\Unit;

use App\Domain\MetricsAggregator;
use App\Events\Stats\HiraganaSelected;
use App\Events\Stats\MySettingsChanged;
use App\Events\Stats\TripViewed;
use App\Events\Stats\UserAvatarUploaded;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MetricsAggregatorTest extends TestCase
{
    use DatabaseTransactions;

    public function testExport()
    {
        $metric1 = class_basename(HiraganaSelected::class);
        $metric2 = class_basename(MySettingsChanged::class);

        $aggregator = $this->app->make(MetricsAggregator::class);
        $aggregator->push($metric1);
        $aggregator->push($metric1);
        $aggregator->push($metric2);
        $aggregator->export();

        $this->assertSame([
            $metric1 => 0,
            $metric2 => 0,
        ], $aggregator->data());

        $this->assertDatabaseHas('metrics', [
            'date' => now()->toDateString(),
            'event' => $metric1,
            'count' => 2,
        ]);

        $this->assertDatabaseHas('metrics', [
            'date' => now()->toDateString(),
            'event' => $metric2,
            'count' => 1,
        ]);
    }

    public function testNotExist()
    {
        $event = 'NotExist';

        $aggregator = $this->app->make(MetricsAggregator::class);
        $aggregator->push($event);

        $this->assertEmpty($aggregator->data());
    }

    public function testPush()
    {
        $event1 = class_basename(TripViewed::class);
        $event2 = class_basename(UserAvatarUploaded::class);

        $aggregator = $this->app->make(MetricsAggregator::class);
        $aggregator->push($event1);
        $aggregator->push($event1);
        $aggregator->push($event2);

        $this->assertSame([
            $event1 => 2,
            $event2 => 1,
        ], $aggregator->data());
    }
}
