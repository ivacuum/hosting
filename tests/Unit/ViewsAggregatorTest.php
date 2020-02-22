<?php namespace Tests\Unit;

use App\Domain\ViewsAggregator;
use App\Factory\TripFactory;
use App\Trip;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ViewsAggregatorTest extends TestCase
{
    use DatabaseTransactions;

    public function testExportTripViews()
    {
        $trip = TripFactory::new()->create();

        $aggregator = new ViewsAggregator;
        $aggregator->push($trip->getTable(), $trip->id);
        $aggregator->push($trip->getTable(), $trip->id);
        $aggregator->export();

        $views = $trip->views;
        $trip->refresh();

        $this->assertEquals(['trips' => []], $aggregator->data());
        $this->assertEquals($views + 2, $trip->views);
    }

    public function testPush()
    {
        $aggregator = new ViewsAggregator;
        $aggregator->push('table', 10);
        $aggregator->push('table', 10);

        $this->assertEquals([
            'table' => [10 => 2]
        ], $aggregator->data());
    }
}
