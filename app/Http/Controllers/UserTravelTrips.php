<?php namespace App\Http\Controllers;

use App\Domain\TripStatus;
use App\Scope\TripNextScope;
use App\Scope\TripPreviousScope;
use App\Scope\TripVisibleScope;
use App\Trip;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class UserTravelTrips extends UserTravel
{
    public function index(User $traveler)
    {
        $to = request('to');
        $from = request('from');

        $validator = \Validator::make([
            'to' => $to,
            'from' => $from,
        ], [
            'to' => 'nullable|date',
            'from' => 'nullable|date',
        ]);

        abort_unless($validator->passes(), 404);

        $trips = Trip::with('user')
            ->withCount('photos')
            ->whereBelongsTo($traveler)
            ->tap(new TripVisibleScope)
            ->when($from, fn (Builder $query) => $query->where('date_start', '>=', $from))
            ->when($to, fn (Builder $query) => $query->where('date_start', '<=', $to))
            ->orderBy('date_start', $from || $to ? 'asc' : 'desc')
            ->get(Trip::COLUMNS_LIST)
            ->groupBy(fn (Trip $model) => $model->year);

        \Breadcrumbs::push(__('Заметки'));

        return view('user-travel.index', ['modelsByYears' => $trips]);
    }

    public function show(User $traveler, string $slug)
    {
        /** @var Trip $trip */
        $trip = Trip::withCount('photos')
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
