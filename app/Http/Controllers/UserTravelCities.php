<?php namespace App\Http\Controllers;

use App\City;
use App\Domain\TripStatus;
use App\Trip;
use App\TripFactory;

class UserTravelCities extends UserTravel
{
    public function index(string $login)
    {
        $trips = TripFactory::tripsByCities($this->traveler->id);

        $cities = \CityHelper::cachedById()
            ->filter(fn (City $city) => isset($trips[$city->id]))
            ->each(function (City $city) use (&$trips) {
                $city->trips_count = $trips[$city->id]['total'] ?? 0;
                $city->trips_published_count = $trips[$city->id]['published'] ?? 0;
            })
            ->sortBy(City::titleField());

        \Breadcrumbs::push(__('Заметки'), "@{$login}/travel");
        \Breadcrumbs::push(__('Города'));

        return view('user-travel.cities', ['cities' => $cities]);
    }

    public function show(string $login, string $slug)
    {
        /** @var City $city */
        $city = \CityHelper::findBySlugOrFail($slug);

        $trips = $city->trips()
            ->whereBelongsTo($this->traveler)
            ->withCount('photos')
            ->visible()
            ->get()
            ->groupBy(fn (Trip $model) => $model->year);

        $publishedTrips = $trips->where('status', TripStatus::PUBLISHED);

        event(new \App\Events\Stats\CityViewed($city->id));

        if (1 === sizeof($publishedTrips)) {
            /** @var \App\Trip $trip */
            $trip = $publishedTrips->first();

            return redirect($trip->www());
        }

        $city->loadCountry();

        \Breadcrumbs::push(__('Заметки'), "@{$login}/travel");
        \Breadcrumbs::push(__('Страны'), "@{$login}/travel/countries");
        \Breadcrumbs::push($city->country->title, "@{$login}/travel/countries/{$city->country->slug}");
        \Breadcrumbs::push($city->title);

        return view('user-travel.city', [
            'city' => $city,
            'modelsByYears' => $trips,
        ]);
    }
}
