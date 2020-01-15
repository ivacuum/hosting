<?php namespace Tests\Unit;

use App\Domain\TripStatsCalculator;
use App\Trip;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TripStatsCalculatorTest extends TestCase
{
    use DatabaseTransactions;

    public function testCityVisits()
    {
        /** @var Trip $trip1 */
        /** @var Trip $trip2 */
        /** @var Trip $trip3 */
        $trip1 = factory(Trip::class)->create(['city_id' => 1]);
        $trip2 = factory(Trip::class)->create(['city_id' => 2]);
        $trip3 = factory(Trip::class)->create(['city_id' => 1]);

        $trips = new Collection([$trip1, $trip2, $trip3]);
        $stats = new TripStatsCalculator($trips);

        $this->assertEquals([
            $trip1->city_id => [$trip1->id, $trip3->id],
            $trip2->city_id => [$trip2->id],
        ], $stats->cityVisits()->toArray());
    }

    public function testDaysInTrips()
    {
        /** @var Trip $trip1 */
        $trip1 = factory(Trip::class)->make();
        $trip1->city_id = 1;
        $trip1->date_end = CarbonImmutable::parse('2015-02-01');
        $trip1->date_start = CarbonImmutable::parse('2015-01-01');

        /** @var Trip $trip2 */
        $trip2 = factory(Trip::class)->make();
        $trip2->city_id = 2;
        $trip2->date_end = CarbonImmutable::parse('2015-02-01');
        $trip2->date_start = CarbonImmutable::parse('2015-01-28');

        /** @var Trip $trip3 */
        $trip3 = factory(Trip::class)->make();
        $trip3->city_id = 2;
        $trip3->date_end = CarbonImmutable::parse('2017-01-01 01:00:00');
        $trip3->date_start = CarbonImmutable::parse('2016-12-31 21:00:00');

        $trips = new Collection([$trip1, $trip2, $trip3]);
        $stats = new TripStatsCalculator($trips);

        $this->assertEquals([
            2015 => 32,
            2016 => 1,
            2017 => 1,
        ], $stats->daysInTrips()->toArray());

        $this->assertEquals($trip1->date_start, $stats->firstDate());
        $this->assertEquals($trip3->date_end, $stats->lastDate());
    }
}
