<?php namespace App\Http\Controllers;

use App\Domain\TripStatus;
use App\Trip;
use Illuminate\Database\Eloquent\Builder;

class UserTravelTrips extends UserTravel
{
    public function index()
    {
        $to = request('to');
        $from = request('from');

        $validator = \Validator::make([
            'to' => $to,
            'from' => $from,
        ], [
            'to' => 'nullable|date',
            'from' => 'nullable|date'
        ]);

        abort_unless($validator->passes(), 404);

        $trips = Trip::with('user')
            ->withCount('photos')
            ->where('user_id', $this->traveler->id)
            ->visible()
            ->when($from, fn (Builder $query) => $query->where('date_start', '>=', $from))
            ->when($to, fn (Builder $query) => $query->where('date_start', '<=', $to))
            ->orderBy('date_start', $from || $to ? 'asc' : 'desc')
            ->get(Trip::COLUMNS_LIST)
            ->groupBy(fn (Trip $model) => $model->year);

        \Breadcrumbs::push(__('Заметки'));

        return view('user-travel.index', ['modelsByYears' => $trips]);
    }

    public function show(string $login, string $slug)
    {
        /** @var Trip $trip */
        $trip = Trip::withCount('photos')
            ->where('user_id', $this->traveler->id)
            ->where('slug', $slug)
            ->where('status', TripStatus::PUBLISHED)
            ->firstOrFail();

        $trip->loadCityAndCountry();

        \Breadcrumbs::push(__('Заметки'), "@{$login}/travel")
            ->push(__('Страны'), "@{$login}/travel/countries")
            ->push($trip->city->country->title, "@{$login}/travel/countries/{$trip->city->country->slug}")
            ->push($trip->city->title, "@{$login}/travel/cities/{$trip->city->slug}")
            ->push($trip->localizedDate());

        event(new \App\Events\Stats\TripViewed($trip->id));

        $nextTrips = $trip->next()->get();

        return view('user-travel.show', [
            'trip' => $trip,
            'comments' => $trip->commentsPublished()->with('user')->orderBy('id')->get(),
            'timeline' => $trip->cityTimeline(),
            'nextTrips' => $nextTrips,
            'previousTrips' => $trip->previous($nextTrips->count())->get()->reverse(),
        ]);
    }
}
