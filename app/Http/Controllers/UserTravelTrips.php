<?php namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Database\Eloquent\Builder;

class UserTravelTrips extends UserTravel
{
    public function index()
    {
        $to = $this->request->input('to');
        $from = $this->request->input('from');

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
            ->get();

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

        \Breadcrumbs::push(trans('menu.life'), "@{$this->traveler->login}/travel");
        \Breadcrumbs::push(trans('menu.countries'), "@{$this->traveler->login}/travel/countries");
        \Breadcrumbs::push($trip->city->country->title, "@{$this->traveler->login}/travel/countries/{$trip->city->country->slug}");
        \Breadcrumbs::push($trip->city->title, "@{$this->traveler->login}/travel/cities/{$trip->city->slug}");
        \Breadcrumbs::push($trip->localizedDate());

        event(new \App\Events\Stats\TripViewed($trip->id));

        $timeline = $trip->cityTimeline();

        $next_trips = $trip->next()->get();
        $previous_trips = $trip->previous($next_trips->count())->get()->reverse();

        $comments = $trip->commentsPublished()->with('user')->orderBy('id')->get();

        return view('user-travel.show', compact('comments', 'next_trips', 'previous_trips', 'timeline', 'trip'));
    }
}
