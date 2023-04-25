<?php namespace App\Http\Controllers;

use App\Action\GetTripCountByCitiesAction;
use App\City;
use App\Domain\TripStatus;
use App\Scope\TripVisibleScope;
use App\Trip;
use App\User;

class UserTravelCityController extends UserTravelController
{
    public function index(User $traveler, GetTripCountByCitiesAction $getTripCountByCities)
    {
        $tripCount = $getTripCountByCities->execute($traveler->id);

        $cities = \CityHelper::cachedById()
            ->filter(fn (City $city) => isset($tripCount[$city->id]))
            ->each(function (City $city) use (&$tripCount) {
                $city->trips_count = $tripCount[$city->id]['total'] ?? 0;
                $city->trips_published_count = $tripCount[$city->id]['published'] ?? 0;
            })
            ->sortBy(City::titleField());

        \Breadcrumbs::push(__('Заметки'), "@{$traveler->login}/travel");
        \Breadcrumbs::push(__('Города'));

        return view('user-travel.cities', ['cities' => $cities]);
    }

    public function show(User $traveler, City $city)
    {
        $trips = $city->trips()
            ->whereBelongsTo($traveler)
            ->withCount('photos')
            ->tap(new TripVisibleScope)
            ->get()
            ->groupBy(fn (Trip $model) => $model->year);

        $publishedTrips = $trips->where('status', TripStatus::Published);

        event(new \App\Events\Stats\CityViewed($city->id));

        if ($publishedTrips->containsOneItem()) {
            /** @var \App\Trip $trip */
            $trip = $publishedTrips->first();

            return redirect($trip->www());
        }

        $city->loadCountry();

        \Breadcrumbs::push(__('Заметки'), "@{$traveler->login}/travel");
        \Breadcrumbs::push(__('Страны'), "@{$traveler->login}/travel/countries");
        \Breadcrumbs::push($city->country->title, "@{$traveler->login}/travel/countries/{$city->country->slug}");
        \Breadcrumbs::push($city->title);

        return view('user-travel.city', [
            'city' => $city,
            'modelsByYears' => $trips,
        ]);
    }
}
