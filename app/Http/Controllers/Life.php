<?php namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Gig;
use App\Trip;

class Life extends Controller
{
    public function index()
    {
        $trips = Trip::withCount('photos')
            ->visible()
            ->orderBy('date_start', 'desc')
            ->get();

        return view($this->view, compact('trips'));
    }

    public function cities()
    {
        $cities = City::orderBy(City::titleField())->get();

        $trips_by_cities = [];

        Trip::visible()
            ->get(['id', 'city_id', 'status'])
            ->each(function ($trip) use (&$trips_by_cities) {
                if ($trip->status === Trip::STATUS_PUBLISHED) {
                    @$trips_by_cities[$trip->city_id]['published'] += 1;
                }

                @$trips_by_cities[$trip->city_id]['total'] += 1;
            });

        $cities = $cities->each(function ($city) use (&$trips_by_cities) {
            $city->trips_count = $trips_by_cities[$city->id]['total'] ?? 0;
            $city->trips_published_count = $trips_by_cities[$city->id]['published'] ?? 0;
        })->filter(function ($city) {
            return $city->trips_count;
        });

        \Breadcrumbs::push(trans('menu.cities'));

        return view($this->view, compact('cities'));
    }

    public function city(City $city)
    {
        $trips = $city->trips()
            ->withCount('photos')
            ->visible()
            ->get();

        $published_trips = $trips->where('status', Trip::STATUS_PUBLISHED);

        event(new \App\Events\Stats\CityViewed($city->id));

        if (1 === sizeof($published_trips)) {
            /* @var \App\Trip $trip */
            $trip = $published_trips->first();

            event(new \App\Events\Stats\CityRedirectedToSingleTrip);

            return redirect($trip->www());
        }

        \Breadcrumbs::push(trans('menu.countries'), 'life/countries');
        \Breadcrumbs::push($city->country->title, "life/countries/{$city->country->slug}");
        \Breadcrumbs::push($city->title);

        return view('life.city', compact('city', 'trips'));
    }

    public function countries()
    {
        $countries = Country::with('cities')->orderBy(Country::titleField())->get();

        $trips_by_cities = [];

        Trip::visible()
            ->get(['id', 'city_id', 'status'])
            ->each(function ($trip) use (&$trips_by_cities) {
                if ($trip->status === Trip::STATUS_PUBLISHED) {
                    @$trips_by_cities[$trip->city_id]['published'] += 1;
                }

                @$trips_by_cities[$trip->city_id]['total'] += 1;
            });

        $countries = $countries->each(function ($country) use (&$trips_by_cities) {
            $trips_count = 0;
            $trips_published_count = 0;

            $country->cities->each(function ($city) use (&$trips_by_cities, &$trips_count, &$trips_published_count) {
                $city->trips_count = $trips_by_cities[$city->id]['total'] ?? 0;
                $city->trips_published_count = $trips_by_cities[$city->id]['published'] ?? 0;

                $trips_count += $city->trips_count;
                $trips_published_count += $city->trips_published_count;
            });

            $country->trips_count = $trips_count;
            $country->trips_published_count = $trips_published_count;
        })->filter(function ($country) {
            return $country->trips_count;
        });

        \Breadcrumbs::push(trans('menu.countries'));

        return view($this->view, compact('countries'));
    }

    public function country($slug)
    {
        $country = Country::where('slug', $slug)->firstOrFail();
        $trips = $country->trips()
            ->withCount('photos')
            ->visible()
            ->get();

        \Breadcrumbs::push(trans('menu.countries'), 'life/countries');
        \Breadcrumbs::push($country->title, "life/countries/{$country->slug}");

        event(new \App\Events\Stats\CountryViewed($country->id));

        return view($this->view, compact('country', 'trips'));
    }

    public function gig(Gig $gig)
    {
        $tpl = $gig->template();

        abort_unless(view()->exists($tpl), 404);

        \Breadcrumbs::push(trans('menu.gigs'), 'life/gigs');
        \Breadcrumbs::push($gig->title);

        event(new \App\Events\Stats\GigViewed($gig->id));

        $timeline = $gig->artistTimeline();

        return view($tpl, compact('gig', 'timeline'));
    }

    public function gigs()
    {
        $gigs = Gig::with('artist')->orderBy('date', 'desc')->get();

        \Breadcrumbs::push(trans('menu.gigs'));

        return view($this->view, compact('gigs'));
    }

    public function page($page)
    {
        $tpl = 'life.' . str_replace('.', '_', $page);

        if (view()->exists($tpl)) {
            return view($tpl, compact('page'));
        }

        if ($trip = $this->getTrip($page)) {
            return $this->trip($trip);
        }

        if ($city = $this->getCity($page)) {
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

        \Breadcrumbs::push(trans('menu.countries'), "life/countries");
        \Breadcrumbs::push($trip->city->country->title, "life/countries/{$trip->city->country->slug}");
        \Breadcrumbs::push($trip->city->title, "life/{$trip->city->slug}");
        \Breadcrumbs::push($trip->localizedDate(), "life/{$trip->slug}");

        event(new \App\Events\Stats\TripViewed($trip->id));

        $timeline = $trip->cityTimeline();

        $next_trips = $trip->next()->get();
        $previous_trips = $trip->previous($next_trips->count())->get()->reverse();

        $comments = $trip->commentsPublished()->with('user')->orderBy('id')->get();

        return view($tpl, compact('comments', 'next_trips', 'previous_trips', 'timeline', 'trip'));
    }

    protected function appendBreadcrumbs()
    {
        $this->middleware('breadcrumbs:menu.life,life');
    }

    /**
     * @param  string $slug
     * @return \App\City
     */
    protected function getCity($slug)
    {
        return City::where('slug', $slug)->first();
    }

    /**
     * @param  string $slug
     * @return \App\Gig
     */
    protected function getGig($slug)
    {
        return Gig::where('slug', $slug)->first();
    }

    /**
     * @param  string $slug
     * @return \App\Trip
     */
    protected function getTrip($slug)
    {
        return Trip::withCount('photos')
            ->where('slug', $slug)
            ->where('status', Trip::STATUS_PUBLISHED)
            ->first();
    }
}
