<?php namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Gig;
use App\Trip;
use Illuminate\Database\Eloquent\Builder;

class Life extends Controller
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

        $trips = Trip::withCount('photos')
            ->where('user_id', 1)
            ->visible()
            ->when($from, function (Builder $query) use ($from) {
                return $query->where('date_start', '>=', $from);
            })
            ->when($to, function (Builder $query) use ($to) {
                return $query->where('date_start', '<=', $to);
            })
            ->orderBy('date_start', $from || $to ? 'asc' : 'desc')
            ->get()
            ->groupBy(function ($model) {
                return $model->year;
            });

        return view($this->view, compact('trips'));
    }

    public function calendar()
    {
        $trips = Trip::query()
            ->where('user_id', 1)
            ->where('city_id', '<>', 1)
            ->visible()
            ->orderBy('date_start')
            ->get();

        $start = $end = null;
        $calendar = [];

        foreach ($trips as $trip) {
            /* @var Trip $trip */
            $end = $end === null || $trip->date_end->gt($end) ? clone $trip->date_end : $end;
            $start = $start === null ? clone $trip->date_start : $start;

            $tripStartedAt = (clone $trip->date_start)->startOfDay();
            $tripEndedAt = (clone $trip->date_end)->startOfDay();

            for ($date = $tripStartedAt; $date->lte($tripEndedAt); $date->addDay()) {
                $ymd = "{$date->year}-{$date->month}-{$date->day}";

                if (!isset($calendar[$ymd])) {
                    $calendar[$ymd] = [];
                }

                $trip->loadCityAndCountry();

                $calendar[$ymd][] = [
                    'flag' => $trip->city->country->flagUrl(),
                    'slug' => $trip->status === Trip::STATUS_PUBLISHED ? $trip->slug : '',
                    'title' => $trip->title,
                ];
            }
        }

        return view($this->view, compact('calendar', 'end', 'start', 'trips'));
    }

    public function cities()
    {
        $trips = Trip::tripsByCities(1);

        $cities = \CityHelper::cachedById()
            ->filter(function ($city, $id) use ($trips) {
                return isset($trips[$id]);
            })
            ->each(function ($city) use (&$trips) {
                $city->trips_count = $trips[$city->id]['total'] ?? 0;
                $city->trips_published_count = $trips[$city->id]['published'] ?? 0;
            })
            ->sortBy(City::titleField());

        return view($this->view, compact('cities'));
    }

    public function city(City $city)
    {
        $trips = $city->trips()
            ->where('user_id', 1)
            ->withCount('photos')
            ->visible()
            ->get()
            ->groupBy(function ($model) {
                return $model->year;
            });

        $published_trips = $trips->where('status', Trip::STATUS_PUBLISHED);

        event(new \App\Events\Stats\CityViewed($city->id));

        if (1 === sizeof($published_trips)) {
            /* @var Trip $trip */
            $trip = $published_trips->first();

            return redirect($trip->www());
        }

        $city->loadCountry();

        \Breadcrumbs::push(trans('menu.countries'), "life/countries")
            ->push($city->country->title, "life/countries/{$city->country->slug}")
            ->push($city->title);

        return view('life.city', compact('city', 'trips'));
    }

    public function countries()
    {
        $countries = Country::allWithCitiesAndTrips(1);

        return view($this->view, compact('countries'));
    }

    public function country($slug)
    {
        $country = \CountryHelper::findBySlugOrFail($slug);

        $trips = $country->trips()
            ->where('user_id', 1)
            ->withCount('photos')
            ->visible()
            ->get()
            ->groupBy(function ($model) {
                return $model->year;
            });

        \Breadcrumbs::push($country->title, "life/countries/{$country->slug}");

        event(new \App\Events\Stats\CountryViewed($country->id));

        return view($this->view, compact('country', 'trips'));
    }

    public function gig(Gig $gig)
    {
        $tpl = $gig->template();

        abort_unless(view()->exists($tpl), 404);

        \Breadcrumbs::push(trans('menu.gigs'), 'life/gigs')
            ->push($gig->title);

        event(new \App\Events\Stats\GigViewed($gig->id));

        $timeline = $gig->artistTimeline();

        // Для собственных фотографий в тексте истории
        $slug = "gigs/{$gig->slug}";

        return view($tpl, compact('gig', 'slug', 'timeline'));
    }

    public function gigs()
    {
        $gigs = Gig::with('artist')
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy(function ($model) {
                return $model->date->year;
            });

        return view($this->view, compact('gigs'));
    }

    public function page($page)
    {
        if ($page === 'japanese') {
            return redirect(path('Japanese@index'), 301);
        }

        $tpl = 'life.' . str_replace('.', '_', $page);

        if (view()->exists($tpl)) {
            return view($tpl, compact('page'));
        }

        if ($trip = $this->getTrip($page)) {
            return $this->trip($trip);
        }

        if (null !== $city = \CityHelper::findBySlug($page)) {
            return $this->city($city);
        }

        if ($gig = $this->getGig($page)) {
            return $this->gig($gig);
        }

        return abort(404);
    }

    public function trip(Trip $trip)
    {
        $tpl = $trip->template();

        abort_unless(view()->exists($tpl), 404);

        $trip->loadCityAndCountry();

        \Breadcrumbs::push(trans('menu.countries'), "life/countries")
            ->push($trip->city->country->title, "life/countries/{$trip->city->country->slug}")
            ->push($trip->city->title, "life/{$trip->city->slug}")
            ->push($trip->localizedDate());

        event(new \App\Events\Stats\TripViewed($trip->id));

        $timeline = $trip->cityTimeline();

        $next_trips = $trip->next()->get();
        $previous_trips = $trip->previous($next_trips->count())->get()->reverse();

        $comments = $trip->commentsPublished()->with('user')->orderBy('created_at')->get();

        return view($tpl, compact('comments', 'next_trips', 'previous_trips', 'timeline', 'trip'));
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:menu.life,life');
        $this->middleware('breadcrumbs:life.calendar,life/calendar')->only('calendar');
        $this->middleware('breadcrumbs:menu.cities,life/cities')->only('cities');
        $this->middleware('breadcrumbs:menu.countries,life/countries')->only('countries', 'country');
        $this->middleware('breadcrumbs:menu.gigs,life/gigs')->only('gigs');
    }

    protected function getGig(string $slug): ?Gig
    {
        return Gig::where('slug', $slug)->first();
    }

    protected function getTrip(string $slug): ?Trip
    {
        return Trip::where('user_id', 1)
            ->withCount('photos')
            ->where('slug', $slug)
            ->where('status', Trip::STATUS_PUBLISHED)
            ->first();
    }
}
