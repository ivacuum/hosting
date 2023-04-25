<?php namespace App\Http\Controllers;

use App\Country;
use App\Scope\TripVisibleScope;
use App\Trip;
use App\User;

class UserTravelCountryController extends UserTravelController
{
    public function index(User $traveler)
    {
        \Breadcrumbs::push(__('Заметки'), "@{$traveler->login}/travel");
        \Breadcrumbs::push(__('Страны'));

        return view('user-travel.countries', [
            'countries' => Country::allWithCitiesAndTrips($traveler->id),
        ]);
    }

    public function show(User $traveler, Country $country)
    {
        $trips = $country->trips()
            ->whereBelongsTo($traveler)
            ->withCount('photos')
            ->tap(new TripVisibleScope)
            ->get()
            ->groupBy(fn (Trip $model) => $model->year);

        \Breadcrumbs::push(__('Заметки'), "@{$traveler->login}/travel");
        \Breadcrumbs::push(__('Страны'), "@{$traveler->login}/travel/countries");
        \Breadcrumbs::push($country->title);

        event(new \App\Events\Stats\CountryViewed($country->id));

        return view('user-travel.country', [
            'country' => $country,
            'modelsByYears' => $trips,
        ]);
    }
}
