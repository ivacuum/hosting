<?php

namespace Tests\Unit;

use App\Domain\Life\Factory\CityFactory;
use App\Domain\Life\Factory\CountryFactory;
use App\Domain\Life\Factory\TripFactory;
use App\Domain\Life\TripStatsCalculator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class TripStatsCalculatorTest extends TestCase
{
    use DatabaseTransactions;

    #[TestWith(['ru', 'Киото', 'Токио'])]
    #[TestWith(['en', 'Kyoto', 'Tokyo'])]
    public function testCalendarAndYearlyCounts(string $locale, string $kyotoTitle, string $tokyoTitle): void
    {
        app()->setLocale($locale);

        $country = CountryFactory::new()->withId(101)->withSlug('japan')->make();

        $kyoto = CityFactory::new()->withId(201)->withCountry($country)->withTitle('Киото', 'Kyoto')->make();
        $kyoto->setRelation('country', $country);

        $tokyo = CityFactory::new()->withId(202)->withCountry($country)->withTitle('Токио', 'Tokyo')->make();
        $tokyo->setRelation('country', $country);

        $trip1 = TripFactory::new()->withCity($kyoto)->withSlug('kyoto-2024')->make();
        $trip1->setRelation('city', $kyoto);
        $trip1->date_start = '2024-02-28 20:00:00';
        $trip1->date_end = '2024-03-01 08:00:00';

        $trip2 = TripFactory::new()->inactive()->withCity($tokyo)->withSlug('tokyo-2024')->make();
        $trip2->setRelation('city', $tokyo);
        $trip2->date_start = '2024-02-29 10:00:00';
        $trip2->date_end = '2024-02-29 12:00:00';

        $trip3 = TripFactory::new()->withCity($kyoto)->withSlug('kyoto-2025')->make();
        $trip3->setRelation('city', $kyoto);
        $trip3->date_start = '2025-01-01 10:00:00';
        $trip3->date_end = '2025-01-01 12:00:00';

        $stats = new TripStatsCalculator(new Collection([$trip1, $trip2, $trip3]));

        $kyotoEntry = [
            'flag' => 'https://ivacuum.org/i/flags/svg/jp.svg',
            'slug' => 'kyoto-2024',
            'title' => $kyotoTitle,
        ];

        $this->assertSame([
            '2024-2-28' => [$kyotoEntry],
            '2024-2-29' => [$kyotoEntry, [
                'flag' => 'https://ivacuum.org/i/flags/svg/jp.svg',
                'slug' => '',
                'title' => $tokyoTitle,
            ]],
            '2024-3-1' => [$kyotoEntry],
            '2025-1-1' => [[
                'flag' => 'https://ivacuum.org/i/flags/svg/jp.svg',
                'slug' => 'kyoto-2025',
                'title' => $kyotoTitle,
            ]],
        ], $stats->calendar()->toArray());
        $this->assertSame([2025 => 1, 2024 => 3], $stats->daysInTrips()->all());
        $this->assertSame([2025 => 1, 2024 => 2], $stats->citiesByYearsCount()->all());
        $this->assertSame([2025 => 1, 2024 => 1], $stats->countriesByYearsCount()->all());
        $this->assertSame([2024 => 2], $stats->newCitiesByYearsCount()->all());
        $this->assertSame([2024 => 1], $stats->newCountriesByYearsCount()->all());
        $this->assertSame('2024-02-28 20:00:00', $stats->firstDate()->toDateTimeString());
        $this->assertSame('2025-01-01 12:00:00', $stats->lastDate()->toDateTimeString());
    }

    public function testCityVisits()
    {
        $trip1 = TripFactory::new()->create();
        $trip2 = TripFactory::new()->create();
        $trip3 = TripFactory::new()->withCity($trip1->city_id)->create();

        $trips = new Collection([$trip1, $trip2, $trip3]);
        $stats = new TripStatsCalculator($trips);

        $this->assertEquals([
            $trip1->city_id => [$trip1->id, $trip3->id],
            $trip2->city_id => [$trip2->id],
        ], $stats->cityVisits()->toArray());
    }

    public function testDaysInTrips()
    {
        $city1 = CityFactory::new()->create();
        $city2 = CityFactory::new()->create();

        $trip1 = TripFactory::new()->withCity($city1)->make();
        $trip1->date_end = '2015-02-01';
        $trip1->date_start = '2015-01-01';

        $trip2 = TripFactory::new()->withCity($city2)->make();
        $trip2->date_end = '2015-02-01';
        $trip2->date_start = '2015-01-28';

        $trip3 = TripFactory::new()->withCity($city2)->make();
        $trip3->date_end = '2017-01-01 01:00:00';
        $trip3->date_start = '2016-12-31 21:00:00';

        $trips = new Collection([$trip1, $trip2, $trip3]);
        $stats = new TripStatsCalculator($trips);

        $this->assertSame([
            2017 => 1,
            2016 => 1,
            2015 => 32,
        ], $stats->daysInTrips()->toArray());

        $this->assertSame([2017 => 1, 2016 => 1, 2015 => 2], $stats->citiesByYearsCount()->all());
        $this->assertSame([2017 => 1, 2016 => 1, 2015 => 2], $stats->countriesByYearsCount()->all());
        $this->assertSame([2015 => 2], $stats->newCitiesByYearsCount()->all());
        $this->assertSame([2015 => 2], $stats->newCountriesByYearsCount()->all());
        $this->assertEquals($trip1->date_start, $stats->firstDate());
        $this->assertEquals($trip3->date_end, $stats->lastDate());
    }

    public function testEmptyCalendar(): void
    {
        $stats = new TripStatsCalculator(new Collection);

        $this->assertNull($stats->firstDate());
        $this->assertNull($stats->lastDate());
        $this->assertSame([], $stats->calendar()->all());
        $this->assertSame([], $stats->daysInTrips()->all());
        $this->assertSame([], $stats->citiesByYearsCount()->all());
        $this->assertSame([], $stats->countriesByYearsCount()->all());
        $this->assertSame([], $stats->newCitiesByYearsCount()->all());
        $this->assertSame([], $stats->newCountriesByYearsCount()->all());
    }
}
