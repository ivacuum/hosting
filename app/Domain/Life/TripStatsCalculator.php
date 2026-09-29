<?php

namespace App\Domain\Life;

use App\Domain\Life\Models\Trip;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Collection;

class TripStatsCalculator
{
    /** @var array<int, array<int, true>> */
    private array $cities = [];

    /** @var array<string, list<array{flag: string, slug: string, title: string}>> */
    private array $calendar = [];

    /** @var array<int, array<int, true>> */
    private array $countries = [];

    /** @var array<int, int> */
    private array $newCities = [];

    /** @var array<int, array<string, true>> */
    private array $daysInTrips = [];

    /** @var array<int, int> */
    private array $newCountries = [];

    /** @var array<int, true> */
    private array $visitedCities = [];

    /** @var array<int, true> */
    private array $visitedCountries = [];

    private CarbonImmutable|null $lastDate = null;
    private CarbonImmutable|null $firstDate = null;

    /** @param \Illuminate\Database\Eloquent\Collection<int, \App\Domain\Life\Models\Trip> $trips */
    public function __construct(private Eloquent\Collection $trips)
    {
        $this->calculate($trips);
    }

    public function calendar(): Collection
    {
        return collect($this->calendar)
            ->map(static fn (array $trips) => collect($trips));
    }

    public function citiesByYearsCount(): Collection
    {
        return collect($this->cities)
            ->reverse()
            ->map(static fn (array $cities) => count($cities));
    }

    public function cityVisits(): Collection
    {
        return $this->trips->mapToDictionary(static fn (Trip $trip) => [$trip->city_id => $trip->id]);
    }

    public function countriesByYearsCount(): Collection
    {
        return collect($this->countries)
            ->reverse()
            ->map(static fn (array $countries) => count($countries));
    }

    public function daysInTrips(): Collection
    {
        return collect($this->daysInTrips)
            ->reverse()
            ->map(static fn (array $days) => count($days));
    }

    public function firstDate(): CarbonImmutable|null
    {
        return $this->firstDate;
    }

    public function lastDate(): CarbonImmutable|null
    {
        return $this->lastDate;
    }

    public function newCitiesByYearsCount(): Collection
    {
        return collect($this->newCities);
    }

    public function newCountriesByYearsCount(): Collection
    {
        return collect($this->newCountries);
    }

    /** @param \Illuminate\Database\Eloquent\Collection<int, \App\Domain\Life\Models\Trip> $trips */
    private function calculate(Eloquent\Collection $trips): void
    {
        foreach ($trips as $trip) {
            $trip->loadCityAndCountry();

            $start = $trip->date_start;
            $end = $trip->date_end;
            $cityId = $trip->city_id;
            $country = $trip->city->country;

            $this->firstDate ??= $start;

            if ($this->lastDate === null || $end->gt($this->lastDate)) {
                $this->lastDate = $end;
            }

            foreach ([$start->year, $end->year] as $year) {
                $this->pushTripCity($year, $cityId);
                $this->pushTripCountry($year, $country->id);
            }

            $this->pushTripDays($start, $end, [
                'flag' => $country->flagUrl(),
                'slug' => $trip->status->isPublished() ? $trip->slug : '',
                'title' => $trip->title,
            ]);
        }
    }

    private function pushTripCity(int $year, int $cityId): void
    {
        if (!isset($this->visitedCities[$cityId])) {
            $this->newCities[$year] = ($this->newCities[$year] ?? 0) + 1;
        }

        $this->cities[$year][$cityId] = true;
        $this->visitedCities[$cityId] = true;
    }

    private function pushTripCountry(int $year, int $countryId): void
    {
        if (!isset($this->visitedCountries[$countryId])) {
            $this->newCountries[$year] = ($this->newCountries[$year] ?? 0) + 1;
        }

        $this->countries[$year][$countryId] = true;
        $this->visitedCountries[$countryId] = true;
    }

    /** @param array{flag: string, slug: string, title: string} $entry */
    private function pushTripDays(CarbonImmutable $start, CarbonImmutable $end, array $entry): void
    {
        $date = $start->startOfDay();
        $tripEndedAt = $end->startOfDay();

        do {
            $year = $date->year;
            $monthDay = "{$date->month}-{$date->day}";

            $this->daysInTrips[$year][$monthDay] = true;
            $this->calendar["{$year}-{$monthDay}"][] = $entry;

            $date = $date->addDay();
        } while ($date->lte($tripEndedAt));
    }
}
