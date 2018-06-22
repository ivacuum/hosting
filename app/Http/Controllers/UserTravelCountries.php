<?php namespace App\Http\Controllers;

use App\Country;
use App\Trip;

class UserTravelCountries extends UserTravel
{
    public function index($login)
    {
        $countries = Country::allWithCitiesAndTrips($this->traveler->id);

        \Breadcrumbs::push(trans('menu.life'), "@{$login}/travel");
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
            ->get()
            ->groupBy(function ($model) {
                return $model->year;
            });

        \Breadcrumbs::push(trans('menu.life'), "@{$login}/travel");
        \Breadcrumbs::push(trans('menu.countries'), "@{$login}/travel/countries");
        \Breadcrumbs::push($country->title);

        event(new \App\Events\Stats\CountryViewed($country->id));

        return view('user-travel.country', compact('country', 'trips'));
    }
}
