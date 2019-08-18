<?php

namespace App\Domain;

use App\Trip;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class TripStatsCalculator
{
    private $days;
    private $cities;
    private $lastDate;
    private $calendar;
    private $countries;
    private $newCities;
    private $firstDate;
    private $newCountries;
    private $visitedCities;
    private $visitedCountries;

    /** @var EloquentCollection|Trip[] */
    private $trips;

    public function __construct(EloquentCollection $trips)
    {
        $this->days = collect();
        $this->trips = $trips;
        $this->cities = collect();
        $this->calendar = collect();
        $this->countries = collect();
        $this->newCities = collect();
        $this->newCountries = collect();
        $this->visitedCities = collect();
        $this->visitedCountries = collect();

        $this->calculate();
    }

    public function calendar(): Collection
    {
        return $this->calendar;
    }

    public function citiesByYearsCount(): Collection
    {
        return $this->cities
            ->reverse()
            ->map(function (Collection $cities) {
                return $cities->unique()->count();
            });
    }

    public function countriesByYearsCount(): Collection
    {
        return $this->countries
            ->reverse()
            ->map(function (Collection $countries) {
                return $countries->unique()->count();
            });
    }

    public function daysInTrips(): Collection
    {
        return $this->days
            ->reverse()
            ->map(function ($trips) {
                return sizeof($trips);
            });
    }

    public function firstDate(): Carbon
    {
        return $this->firstDate;
    }

    public function lastDate(): Carbon
    {
        return $this->lastDate;
    }

    public function newCitiesByYearsCount(): Collection
    {
        return $this->newCities->map(function (Collection $cities) {
            return $cities->count();
        });
    }

    public function newCountriesByYearsCount(): Collection
    {
        return $this->newCountries->map(function (Collection $countries) {
            return $countries->count();
        });
    }

    private function calculate(): void
    {
        foreach ($this->trips as $trip) {
            $trip->loadCityAndCountry();

            $this->saveLastDate($trip);
            $this->saveFirstDate($trip);

            $this->pushTripDays($trip);
            $this->pushTripCities($trip);
            $this->pushTripCountries($trip);
            $this->pushTripToCalendar($trip);
        }
    }

    private function pushCity(int $cityId, int $year): void
    {
        if (!isset($this->cities[$year])) {
            $this->cities[$year] = collect();
        }

        $this->cities[$year][] = $cityId;
    }

    private function pushCountry(int $countryId, int $year): void
    {
        if (!isset($this->countries[$year])) {
            $this->countries[$year] = collect();
        }

        $this->countries[$year][] = $countryId;
    }

    private function pushNewCity(int $cityId, int $year): void
    {
        if (!isset($this->newCities[$year])) {
            $this->newCities[$year] = collect();
        }

        $this->newCities[$year][] = $cityId;
    }

    private function pushNewCountry(int $countryId, int $year): void
    {
        if (!isset($this->newCountries[$year])) {
            $this->newCountries[$year] = collect();
        }

        $this->newCountries[$year][] = $countryId;
    }

    private function pushTripCities(Trip $trip): void
    {
        $year = $trip->date_start->year;
        $cityId = $trip->city_id;

        if (!isset($this->visitedCities[$cityId])) {
            $this->pushNewCity($cityId, $year);
        }

        $this->pushCity($cityId, $year);

        $this->visitedCities[$cityId] = true;
    }

    private function pushTripCountries(Trip $trip): void
    {
        $year = $trip->date_start->year;
        $countryId = $trip->city->country_id;

        if (!isset($this->visitedCountries[$countryId])) {
            $this->pushNewCountry($countryId, $year);
        }

        $this->pushCountry($countryId, $year);

        $this->visitedCountries[$countryId] = true;
    }

    private function pushTripDays(Trip $trip): void
    {
        $tripEndedAt = (clone $trip->date_end)->startOfDay();
        $tripStartedAt = (clone $trip->date_start)->startOfDay();

        for ($date = $tripStartedAt; $date->lte($tripEndedAt); $date->addDay()) {
            $year = $date->year;
            $monthDay = "{$date->month}-{$date->day}";

            if (!isset($this->days[$year])) {
                $this->days[$year] = collect();
            }

            $this->days[$year][$monthDay] = true;
        }
    }

    private function pushTripToCalendar(Trip $trip): void
    {
        $tripEndedAt = (clone $trip->date_end)->startOfDay();
        $tripStartedAt = (clone $trip->date_start)->startOfDay();

        for ($date = $tripStartedAt; $date->lte($tripEndedAt); $date->addDay()) {
            $ymd = "{$date->year}-{$date->month}-{$date->day}";

            if (!isset($this->calendar[$ymd])) {
                $this->calendar[$ymd] = collect();
            }

            $this->calendar[$ymd][] = [
                'flag' => $trip->city->country->flagUrl(),
                'slug' => $trip->status === Trip::STATUS_PUBLISHED ? $trip->slug : '',
                'title' => $trip->title,
            ];
        }
    }

    private function saveFirstDate(Trip $trip): void
    {
        $this->firstDate = $this->firstDate === null
            ? clone $trip->date_start
            : $this->firstDate;
    }

    private function saveLastDate(Trip $trip): void
    {
        $this->lastDate = $this->lastDate === null || $trip->date_end->gt($this->lastDate)
            ? clone $trip->date_end
            : $this->lastDate;
    }
}