<?php namespace App\Http\Controllers;

use App;
use App\City;
use App\Country;
use App\Gig;
use App\Trip;
use Breadcrumbs;

class Life extends Controller
{
    public function index()
    {
        $trips = Trip::orderBy('date_start', 'desc')->get();

        return view($this->view, compact('trips'));
    }

    public function cities()
    {
        $locale = App::getLocale();
        $cities = City::with('tripsCount')->orderBy("title_{$locale}")->get();

        Breadcrumbs::push(trans('menu.life'), 'life');
        Breadcrumbs::push(trans('menu.cities'));

        return view($this->view, compact('cities'));
    }

    public function city(City $city)
    {
        $published_trips = $city->trips->where('status', Trip::STATUS_PUBLISHED);

        if (1 === sizeof($published_trips)) {
            $slug = $published_trips->first()->slug;

            return redirect()->action("{$this->class}@page", $slug);
        }

        Breadcrumbs::push(trans('menu.countries'), 'life/countries');
        Breadcrumbs::push($city->country->title, "life/countries/{$city->country->slug}");
        Breadcrumbs::push($city->title);

        return view('life.city', compact('city'));
    }

    public function countries()
    {
        $locale = App::getLocale();
        $countries = Country::with('cities')->orderBy("title_{$locale}")->get();

        $trips_by_cities = [];

        Trip::where('status', Trip::STATUS_PUBLISHED)
            ->get(['id', 'city_id'])
            ->each(function ($trip) use (&$trips_by_cities) {
                @$trips_by_cities[$trip->city_id] += 1;
            });

        $countries->each(function ($country) use (&$trips_by_cities) {
            $trips_count = 0;

            $country->cities->each(function ($city) use (&$trips_by_cities, &$trips_count) {
                $city->trips_count = $trips_by_cities[$city->id] ?? 0;
                $trips_count += $city->trips_count;
            });

            $country->trips_count = $trips_count;
        });

        Breadcrumbs::push(trans('menu.life'), 'life');
        Breadcrumbs::push(trans('menu.countries'));

        return view($this->view, compact('countries'));
    }

    public function country($slug)
    {
        $country = Country::with('cities')->where('slug', $slug)->firstOrFail();
        $trips = Trip::whereIn('city_id', $country->cities->pluck('id'))
            ->orderBy('date_start', 'desc')
            ->get();

        Breadcrumbs::push(trans('menu.life'), 'life');
        Breadcrumbs::push(trans('menu.countries'), 'life/countries');
        Breadcrumbs::push($country->title, "life/countries/{$country->slug}");

        return view($this->view, compact('country', 'trips'));
    }

    public function gig(Gig $gig)
    {
        $tpl = "life.gigs.{$gig->tpl}";

        if (!view()->exists($tpl)) {
            abort(404);
        }

        Breadcrumbs::push(trans('menu.gigs'), 'life/gigs');
        Breadcrumbs::push($gig->title);

        $timeline = $gig->artistTimeline();

        return view($tpl, compact('gig', 'timeline'));
    }

    public function gigs()
    {
        $gigs = Gig::with('artist')->orderBy('date', 'desc')->get();

        Breadcrumbs::push(trans('menu.life'), 'life');
        Breadcrumbs::push(trans('menu.gigs'));

        return view($this->view, compact('gigs'));
    }

    public function page($page)
    {
        Breadcrumbs::push(trans('menu.life'), 'life');

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

        abort(404);
    }

    public function trip(Trip $trip)
    {
        $tpl = "life.trips.{$trip->tpl}";

        if (!view()->exists($tpl)) {
            abort(404);
        }

        Breadcrumbs::push(trans('menu.countries'), "life/countries");
        Breadcrumbs::push($trip->city->country->title, "life/countries/{$trip->city->country->slug}");
        Breadcrumbs::push($trip->city->title, "life/{$trip->city->slug}");
        Breadcrumbs::push($trip->localizedDate(), "life/{$trip->slug}");

        $timeline = $trip->cityTimeline();

        $next_trips = $trip->next()->get();
        $previous_trips = $trip->previous($next_trips->count())->get()->reverse();

        return view($tpl, compact('next_trips', 'previous_trips', 'timeline', 'trip'));
    }

    protected function getCity($slug)
    {
        return City::where('slug', $slug)->first();
    }

    protected function getGig($slug)
    {
        return Gig::where('slug', $slug)->first();
    }

    protected function getTrip($slug)
    {
        return Trip::where('slug', $slug)
            ->where('status', Trip::STATUS_PUBLISHED)
            ->first();
    }
}
