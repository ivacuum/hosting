<?php namespace App\Http\Controllers;

use App\Domain\TripStatsCalculator;
use App\Http\Requests\LifeCalendarRequest;

class Calendar extends Controller
{
    public function __invoke(LifeCalendarRequest $request)
    {
        $trips = $request->trips();
        $stats = new TripStatsCalculator($trips);

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
