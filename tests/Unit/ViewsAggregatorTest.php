<?php

namespace Tests\Unit;

use App\Domain\ViewsAggregator;
use App\Factory\TripFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ViewsAggregatorTest extends TestCase
{
    use DatabaseTransactions;

    public function testExportTripViews()
    {
        $trip = TripFactory::new()->create();

        $aggregator = $this->app->make(ViewsAggregator::class);
        $aggregator->push($trip->getTable(), $trip->id);
        $aggregator->push($trip->getTable(), $trip->id);
        $aggregator->export();

        $views = $trip->views;
        $trip->refresh();

        $this->assertSame(['trips' => []], $aggregator->data());
        $this->assertSame($views + 2, $trip->views);
    }

    public function testPush()
    {
        $aggregator = $this->app->make(ViewsAggregator::class);
        $aggregator->push('table', 10);
        $aggregator->push('table', 10);

        $this->assertSame([
            'table' => [10 => 2],
        ], $aggregator->data());
    }
}
