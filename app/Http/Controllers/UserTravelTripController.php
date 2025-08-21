<?php

namespace App\Http\Controllers;

use App\Domain\Life\Models\Trip;
use App\Domain\Life\Scope\TripNextScope;
use App\Domain\Life\Scope\TripPreviousScope;
use App\Domain\Life\Scope\TripVisibleScope;
use App\Domain\Life\TripStatus;
use App\Http\Requests\LifeIndexForm;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class UserTravelTripController extends UserTravelController
{
    public function index(User $traveler, LifeIndexForm $request)
    {
        $trips = Trip::query()
            ->with('user')
            ->withCount('photos')
            ->whereBelongsTo($traveler)
            ->tap(new TripVisibleScope)
            ->when($request->from, fn (Builder $query) => $query->where('date_start', '>=', $request->from))
            ->when($request->to, fn (Builder $query) => $query->where('date_start', '<=', $request->to))
            ->orderBy('date_start', $request->from || $request->to ? 'asc' : 'desc')
            ->get(Trip::COLUMNS_LIST)
            ->groupBy(fn (Trip $model) => $model->year);

        \Breadcrumbs::push(__('Заметки'));

        return view('user-travel.index', ['modelsByYears' => $trips]);
    }

    public function show(User $traveler, string $slug)
    {
        /** @var Trip $trip */
        $trip = Trip::query()
            ->withCount('photos')
            ->whereBelongsTo($traveler)
            ->where('slug', $slug)
            ->where('status', TripStatus::Published)
            ->firstOrFail();

        $trip->loadCityAndCountry();

        \Breadcrumbs::push(__('Заметки'), "@{$traveler->login}/travel")
            ->push(__('Страны'), "@{$traveler->login}/travel/countries")
            ->push($trip->city->country->title, "@{$traveler->login}/travel/countries/{$trip->city->country->slug}")
            ->push($trip->city->title, "@{$traveler->login}/travel/cities/{$trip->city->slug}")
            ->push($trip->localizedDate());

        event(new \App\Events\Stats\TripViewed($trip->id));

        $nextTrips = $trip->tap(new TripNextScope($trip))->get();

        return view('user-travel.show', [
            'trip' => $trip,
            'comments' => true,
            'timeline' => $trip->cityTimeline(),
            'nextTrips' => $nextTrips,
            'previousTrips' => $trip->tap(new TripPreviousScope($trip, $nextTrips->count()))
                ->get()
                ->reverse(),
        ]);
    }
}
