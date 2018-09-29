<?php namespace App\Http\Controllers;

use App\City;
use App\Trip;

class UserTravelCities extends UserTravel
{
    public function index(string $login)
    {
        $trips = Trip::tripsByCities($this->traveler->id);

        $cities = \CityHelper::cachedById()
            ->filter(function ($city, $id) use ($trips) {
                return isset($trips[$id]);
            })
            ->each(function ($city) use (&$trips) {
                $city->trips_count = $trips[$city->id]['total'] ?? 0;
                $city->trips_published_count = $trips[$city->id]['published'] ?? 0;
            })
            ->sortBy(City::titleField());

        \Breadcrumbs::push(trans('menu.life'), "@{$login}/travel");
        \Breadcrumbs::push(trans('menu.cities'));

        return view('user-travel.cities', compact('cities'));
    }

    public function show(string $login, string $slug)
    {
        $city = \CityHelper::findBySlugOrFail($slug);

        $trips = $city->trips()
            ->where('user_id', $this->traveler->id)
            ->withCount('photos')
            ->visible()
            ->get()
            ->groupBy(function ($model) {
                return $model->year;
            });

        $published_trips = $trips->where('status', Trip::STATUS_PUBLISHED);

        event(new \App\Events\Stats\CityViewed($city->id));

        if (1 === sizeof($published_trips)) {
            /* @var \App\Trip $trip */
            $trip = $published_trips->first();

            return redirect($trip->www());
        }

        $city->loadCountry();

        \Breadcrumbs::push(trans('menu.life'), "@{$login}/travel");
        \Breadcrumbs::push(trans('menu.countries'), "@{$login}/travel/countries");
        \Breadcrumbs::push($city->country->title, "@{$login}/travel/countries/{$city->country->slug}");
        \Breadcrumbs::push($city->title);

        return view('user-travel.city', compact('city', 'trips'));
    }
}
