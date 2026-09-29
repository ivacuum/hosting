<?php

namespace App\Http\Controllers;

use App\Domain\Life\TripStatsCalculator;
use App\Http\Requests\LifeCalendarForm;

class CalendarController
{
    public function __invoke(LifeCalendarForm $request)
    {
        $stats = new TripStatsCalculator($request->trips());

        return view('life.calendar', [
            'cities' => $stats->citiesByYearsCount(),
            'calendar' => $stats->calendar(),
            'lastDate' => $stats->lastDate(),
            'countries' => $stats->countriesByYearsCount(),
            'firstDate' => $stats->firstDate(),
            'newCities' => $stats->newCitiesByYearsCount(),
            'daysInTrips' => $stats->daysInTrips(),
            'newCountries' => $stats->newCountriesByYearsCount(),
        ]);
    }
}
