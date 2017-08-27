<?php namespace App\Http\Controllers;

use App\Country;
use App\Trip;

class UserTravelCountries extends UserTravel
{
    public function index()
    {
        $trips = Trip::tripsByCities($this->traveler->id);

        $countries = Country::with('cities')
            ->orderBy(Country::titleField())
            ->get()
            ->each(function ($country) use (&$trips) {
                $trips_count = 0;
                $trips_published_count = 0;

                $country->filtered_cities = $country->cities->each(function ($city) use (&$trips, &$trips_count, &$trips_published_count) {
                    $city->trips_count = $trips[$city->id]['total'] ?? 0;
                    $city->trips_published_count = $trips[$city->id]['published'] ?? 0;

                    $trips_count += $city->trips_count;
                    $trips_published_count += $city->trips_published_count;
                })->filter->trips_count;

                $country->trips_count = $trips_count;
                $country->trips_published_count = $trips_published_count;
            })->filter->trips_count;

        \Breadcrumbs::push(trans('menu.life'), "@{$this->traveler->login}/travel");
        \Breadcrumbs::push(trans('menu.countries'));

        return view('user-travel.countries', compact('countries'));
    }

    public function show($login, $slug)
    {
        $country = Country::where('slug', $slug)->firstOrFail();
        $trips = $country->trips()
            ->where('user_id', $this->traveler->id)
            ->withCount('photos')
            ->visible()
            ->get();

        \Breadcrumbs::push(trans('menu.life'), "@{$this->traveler->login}/travel");
        \Breadcrumbs::push(trans('menu.countries'), "@{$this->traveler->login}/travel/countries");
        \Breadcrumbs::push($country->title);

        event(new \App\Events\Stats\CountryViewed($country->id));

        return view('user-travel.country', compact('country', 'trips'));
    }
}
