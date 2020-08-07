<?php namespace App\Http\Controllers;

use App\Country;
use App\Trip;

class UserTravelCountries extends UserTravel
{
    public function index(string $login)
    {
        \Breadcrumbs::push(__('Заметки'), "@{$login}/travel");
        \Breadcrumbs::push(__('Страны'));

        return view('user-travel.countries', [
            'countries' => Country::allWithCitiesAndTrips($this->traveler->id),
        ]);
    }

    public function show(string $login, string $slug)
    {
        /** @var Country $country */
        $country = Country::where('slug', $slug)->firstOrFail();
        $trips = $country->trips()
            ->where('user_id', $this->traveler->id)
            ->withCount('photos')
            ->visible()
            ->get()
            ->groupBy(fn (Trip $model) => $model->year);

        \Breadcrumbs::push(__('Заметки'), "@{$login}/travel");
        \Breadcrumbs::push(__('Страны'), "@{$login}/travel/countries");
        \Breadcrumbs::push($country->title);

        event(new \App\Events\Stats\CountryViewed($country->id));

        return view('user-travel.country', [
            'trips' => $trips,
            'country' => $country,
        ]);
    }
}
