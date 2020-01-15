<?php namespace App\Domain;

use App\Trip;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class TripStatsCalculator
{
    private $cities;
    private $lastDate;
    private $calendar;
    private $countries;
    private $newCities;
    private $firstDate;
    private $cityVisits;
    private $daysInTrips;
    private $daysInCities;
    private $newCountries;
    private $visitedCities;
    private $daysInCountries;
    private $visitedCountries;

    public function __construct(EloquentCollection $trips)
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
            ->map(function ($years) {
                return $years->reverse()->map(fn ($days) => sizeof($days));
            });
    }

    public function daysInCountries(): Collection
    {
        return $this->daysInCountries
            ->map(function ($years) {
                return $years->reverse()->map(fn ($days) => sizeof($days));
            });
    }

    public function daysInTrips(): Collection
    {
        return $this->daysInTrips
            ->reverse()
            ->map(fn ($trips) => sizeof($trips));
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

    private function calculate(EloquentCollection $trips): void
    {
        /** @var Trip $trip */
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

            if (!isset($this->daysInTrips[$year])) {
                $this->daysInTrips[$year] = collect();
            }

            if (!isset($this->daysInCities[$trip->city_id])) {
                $this->daysInCities[$trip->city_id] = collect();
            }

            if (!isset($this->daysInCities[$trip->city_id][$year])) {
                $this->daysInCities[$trip->city_id][$year] = collect();
            }

            if (!isset($this->daysInCountries[$trip->city->country_id])) {
                $this->daysInCountries[$trip->city->country_id] = collect();
            }

            if (!isset($this->daysInCountries[$trip->city->country_id][$year])) {
                $this->daysInCountries[$trip->city->country_id][$year] = collect();
            }

            $this->daysInTrips[$year][$monthDay] = true;
            $this->daysInCities[$trip->city_id][$year][$monthDay] = true;
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

            if (!isset($this->calendar[$ymd])) {
                $this->calendar[$ymd] = collect();
            }

            $this->calendar[$ymd][] = [
                'flag' => $trip->city->country->flagUrl(),
                'slug' => $trip->isPublished() ? $trip->slug : '',
                'title' => $trip->title,
            ];

            $date = $date->addDay();
        } while ($date->lte($tripEndedAt));
    }

    private function saveFirstDate(Trip $trip): void
    {
        $this->firstDate = $this->firstDate === null
            ? $trip->date_start
            : $this->firstDate;
    }

    private function saveLastDate(Trip $trip): void
    {
        $this->lastDate = $this->lastDate === null || $trip->date_end->gt($this->lastDate)
            ? $trip->date_end
            : $this->lastDate;
    }
}
