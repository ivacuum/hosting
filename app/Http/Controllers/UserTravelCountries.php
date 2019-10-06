<?php namespace App\Http\Controllers;

use App\Country;

class UserTravelCountries extends UserTravel
{
    public function index(string $login)
    {
        \Breadcrumbs::push(trans('menu.life'), "@{$login}/travel");
        \Breadcrumbs::push(trans('menu.countries'));

        return view('user-travel.countries', [
            'countries' => Country::allWithCitiesAndTrips($this->traveler->id),
        ]);
    }

    public function show(string $login, string $slug)
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

        return view('user-travel.country', [
            'trips' => $trips,
            'country' => $country,
        ]);
    }
}
