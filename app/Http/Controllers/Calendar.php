<?php namespace App\Http\Controllers;

use App\Domain\TripStatsCalculator;
use App\Http\Requests\LifeCalendarForm;

class Calendar
{
    public function __invoke(LifeCalendarForm $request)
    {
        $trips = $request->trips();
        $stats = new TripStatsCalculator($trips);

        // Попытка отловить ошибку в среде github actions
        if (app()->runningUnitTests()) {
            try {
                $stats->lastDate();
            } catch (\Throwable) {
                dd($trips, \App\Trip::all());
            }
        }

        return view('life.calendar', [
            'trips' => $trips,
            'cities' => $stats->citiesByYearsCount(),
            'calendar' => $stats->calendar(),
            'lastDate' => $stats->lastDate(),
            'countries' => $stats->countriesByYearsCount(),
            'firstDate' => $stats->firstDate(),
            'newCities' => $stats->newCitiesByYearsCount(),
            'cityVisits' => $stats->cityVisits(),
            'daysInTrips' => $stats->daysInTrips(),
            'daysInCities' => $stats->daysInCities(),
            'newCountries' => $stats->newCountriesByYearsCount(),
            'daysInCountries' => $stats->daysInCountries(),
        ]);
    }
}
