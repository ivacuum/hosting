<?php

namespace Tests\Unit;

use App\Domain\Life\Factory\TripFactory;
use App\Domain\Life\TripStatsCalculator;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TripStatsCalculatorTest extends TestCase
{
    use DatabaseTransactions;

    public function testCityVisits()
    {
        $trip1 = TripFactory::new()->create();
        $trip2 = TripFactory::new()->create();
        $trip3 = TripFactory::new()->withCityId($trip1->city_id)->create();

        $trips = new Collection([$trip1, $trip2, $trip3]);
        $stats = new TripStatsCalculator($trips);

        $this->assertEquals([
            $trip1->city_id => [$trip1->id, $trip3->id],
            $trip2->city_id => [$trip2->id],
        ], $stats->cityVisits()->toArray());
    }

    public function testDaysInTrips()
    {
        $trip1 = TripFactory::new()->make();
        $trip1->date_end = CarbonImmutable::parse('2015-02-01');
        $trip1->date_start = CarbonImmutable::parse('2015-01-01');

        $trip2 = TripFactory::new()->make();
        $trip2->date_end = CarbonImmutable::parse('2015-02-01');
        $trip2->date_start = CarbonImmutable::parse('2015-01-28');

        $trip3 = TripFactory::new()->withCityId($trip2->city_id)->make();
        $trip3->date_end = CarbonImmutable::parse('2017-01-01 01:00:00');
        $trip3->date_start = CarbonImmutable::parse('2016-12-31 21:00:00');

        $trips = new Collection([$trip1, $trip2, $trip3]);
        $stats = new TripStatsCalculator($trips);

        $this->assertSame([
            2017 => 1,
            2016 => 1,
            2015 => 32,
        ], $stats->daysInTrips()->toArray());

        $this->assertEquals($trip1->date_start, $stats->firstDate());
        $this->assertEquals($trip3->date_end, $stats->lastDate());
    }
}
