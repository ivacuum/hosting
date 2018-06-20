<?php namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Database\Eloquent\Builder;

class UserTravelTrips extends UserTravel
{
    public function index()
    {
        $to = request('to');
        $from = request('from');

        $validator = \Validator::make(compact('from', 'to'), [
            'to' => 'nullable|date',
            'from' => 'nullable|date'
        ]);

        abort_unless($validator->passes(), 404);

        $trips = Trip::with('user')
            ->withCount('photos')
            ->where('user_id', $this->traveler->id)
            ->visible()
            ->when($from, function (Builder $query) use ($from) {
                return $query->where('date_start', '>=', $from);
            })
            ->when($to, function (Builder $query) use ($to) {
                return $query->where('date_start', '<=', $to);
            })
            ->orderBy('date_start', $from || $to ? 'asc' : 'desc')
            ->get(Trip::COLUMNS_LIST)
            ->groupBy(function ($model) {
                return $model->year;
            });

        \Breadcrumbs::push(trans('menu.life'));

        return view('user-travel.index', compact('trips'));
    }

    public function show($login, $slug)
    {
        $trip = Trip::withCount('photos')
            ->where('user_id', $this->traveler->id)
            ->where('slug', $slug)
            ->where('status', Trip::STATUS_PUBLISHED)
            ->firstOrFail();

        $trip->loadCityAndCountry();

        \Breadcrumbs::push(trans('menu.life'), "@{$login}/travel")
            ->push(trans('menu.countries'), "@{$login}/travel/countries")
            ->push($trip->city->country->title, "@{$login}/travel/countries/{$trip->city->country->slug}")
            ->push($trip->city->title, "@{$login}/travel/cities/{$trip->city->slug}")
            ->push($trip->localizedDate());

        event(new \App\Events\Stats\TripViewed($trip->id));

        $timeline = $trip->cityTimeline();

        $next_trips = $trip->next()->get();
        $previous_trips = $trip->previous($next_trips->count())->get()->reverse();

        $comments = $trip->commentsPublished()->with('user')->orderBy('id')->get();

        return view('user-travel.show', compact('comments', 'next_trips', 'previous_trips', 'timeline', 'trip'));
    }
}
