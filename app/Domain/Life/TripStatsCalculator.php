<?php

namespace App\Domain\Life;

use App\Domain\Life\Models\Trip;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Collection;

class TripStatsCalculator
{
    private Collection $cities;
    private Collection $calendar;
    private Collection $countries;
    private Collection $newCities;
    private Collection $daysInTrips;
    private Collection $daysInCities;
    private Collection $newCountries;
    private Collection $visitedCities;
    private Collection $daysInCountries;
    private Collection $visitedCountries;
    private CarbonImmutable|null $lastDate = null;
    private CarbonImmutable|null $firstDate = null;
    private Eloquent\Collection $cityVisits;

    /** @param \Illuminate\Database\Eloquent\Collection<int, \App\Domain\Life\Models\Trip> $trips */
    public function __construct(Eloquent\Collection $trips)
    {
        $this->cities = collect();
        $this->calendar = collect();
        $this->countries = collect();
        $this->newCities = collect();
        $this->newCountries = collect();
        $this->visitedCities = collect();
        $this->visitedCountries = collect();

        $this->daysInTrips = collect();
        $this->daysInCities = collect();
        $this->daysInCountries = collect();

        $this->calculate($trips);

        $this->cityVisits = $trips->mapToDictionary(fn (Trip $trip) => [$trip->city_id => $trip->id]);
    }

    public function calendar(): Collection
    {
        return $this->calendar;
    }

    public function citiesByYearsCount(): Collection
    {
        return $this->cities
            ->reverse()
            ->map(fn (Collection $cities) => $cities->unique()->count());
    }

    public function cityVisits(): Collection
    {
        return $this->cityVisits;
    }

    public function countriesByYearsCount(): Collection
    {
        return $this->countries
            ->reverse()
            ->map(fn (Collection $countries) => $countries->unique()->count());
    }

    public function daysInCities(): Collection
    {
        return $this->daysInCities
            ->map(fn ($years) => $years->reverse()->map(fn (Collection $days) => $days->count()));
    }

    public function daysInCountries(): Collection
    {
        return $this->daysInCountries
            ->map(fn ($years) => $years->reverse()->map(fn (Collection $days) => $days->count()));
    }

    public function daysInTrips(): Collection
    {
        return $this->daysInTrips
            ->reverse()
            ->map(fn (Collection $trips) => $trips->count());
    }

    public function firstDate(): CarbonImmutable
    {
        return $this->firstDate;
    }

    public function lastDate(): CarbonImmutable
    {
        return $this->lastDate;
    }

    public function newCitiesByYearsCount(): Collection
    {
        return $this->newCities->map(fn (Collection $cities) => $cities->count());
    }

    public function newCountriesByYearsCount(): Collection
    {
        return $this->newCountries->map(fn (Collection $countries) => $countries->count());
    }

    /** @param \Illuminate\Database\Eloquent\Collection<int, \App\Domain\Life\Models\Trip> $trips */
    private function calculate(Eloquent\Collection $trips): void
    {
        foreach ($trips as $trip) {
            $trip->loadCityAndCountry();

            $this->saveLastDate($trip);
            $this->saveFirstDate($trip);

            $this->pushTripDays($trip);
            $this->pushTripCity($trip->date_start->year, $trip->city_id);
            $this->pushTripCity($trip->date_end->year, $trip->city_id);
            $this->pushTripCountry($trip->date_start->year, $trip->city->country_id);
            $this->pushTripCountry($trip->date_end->year, $trip->city->country_id);
            $this->pushTripToCalendar($trip);
        }
    }

    private function pushCity(int $cityId, int $year): void
    {
        $this->cities[$year] ??= collect();
        $this->cities[$year][] = $cityId;
    }

    private function pushCountry(int $countryId, int $year): void
    {
        $this->countries[$year] ??= collect();
        $this->countries[$year][] = $countryId;
    }

    private function pushNewCity(int $cityId, int $year): void
    {
        $this->newCities[$year] ??= collect();
        $this->newCities[$year][] = $cityId;
    }

    private function pushNewCountry(int $countryId, int $year): void
    {
        $this->newCountries[$year] ??= collect();
        $this->newCountries[$year][] = $countryId;
    }

    private function pushTripCity(int $year, int $cityId): void
    {
        if (!isset($this->visitedCities[$cityId])) {
            $this->pushNewCity($cityId, $year);
        }

        $this->pushCity($cityId, $year);

        $this->visitedCities[$cityId] = true;
    }

    private function pushTripCountry(int $year, int $countryId): void
    {
        if (!isset($this->visitedCountries[$countryId])) {
            $this->pushNewCountry($countryId, $year);
        }

        $this->pushCountry($countryId, $year);

        $this->visitedCountries[$countryId] = true;
    }

    private function pushTripDays(Trip $trip): void
    {
        $date = $trip->date_start->startOfDay();
        $tripEndedAt = $trip->date_end->startOfDay();

        do {
            $year = $date->year;
            $monthDay = "{$date->month}-{$date->day}";

            $this->daysInTrips[$year] ??= collect();
            $this->daysInTrips[$year][$monthDay] = true;
            $this->daysInCities[$trip->city_id] ??= collect();
            $this->daysInCities[$trip->city_id][$year] ??= collect();
            $this->daysInCities[$trip->city_id][$year][$monthDay] = true;
            $this->daysInCountries[$trip->city->country_id] ??= collect();
            $this->daysInCountries[$trip->city->country_id][$year] ??= collect();
            $this->daysInCountries[$trip->city->country_id][$year][$monthDay] = true;

            $date = $date->addDay();
        } while ($date->lte($tripEndedAt));
    }

    private function pushTripToCalendar(Trip $trip): void
    {
        $date = $trip->date_start->startOfDay();
        $tripEndedAt = $trip->date_end->startOfDay();

        do {
            $ymd = "{$date->year}-{$date->month}-{$date->day}";

            $this->calendar[$ymd] ??= collect();
            $this->calendar[$ymd][] = [
                'flag' => $trip->city->country->flagUrl(),
                'slug' => $trip->status->isPublished() ? $trip->slug : '',
                'title' => $trip->title,
            ];

            $date = $date->addDay();
        } while ($date->lte($tripEndedAt));
    }

    private function saveFirstDate(Trip $trip): void
    {
        $this->firstDate ??= $trip->date_start;
    }

    private function saveLastDate(Trip $trip): void
    {
        $this->lastDate = $this->lastDate === null || $trip->date_end->gt($this->lastDate)
            ? $trip->date_end
            : $this->lastDate;
    }
}
