<?php namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Gig;
use App\Http\Requests\LifeIndexRequest;
use App\Trip;
use App\TripFactory;
use Illuminate\Database\Eloquent\Builder;

class Life extends Controller
{
    public function index(LifeIndexRequest $request)
    {
        $to = $request->to();
        $from = $request->from();

        $trips = Trip::withCount('photos')
            ->where('user_id', 1)
            ->visible()
            ->when($from, fn (Builder $query) => $query->where('date_start', '>=', $from))
            ->when($to, fn (Builder $query) => $query->where('date_start', '<=', $to))
            ->orderBy('date_start', $from || $to ? 'asc' : 'desc')
            ->get()
            ->groupBy(fn (Trip $model) => $model->year);

        return view('life.index', [
            'trips' => $trips,
            'metaTitle' => __('Заметки'),
        ]);
    }

    public function cities()
    {
        $trips = TripFactory::tripsByCities(1);

        $cities = \CityHelper::cachedById()
            ->filter(fn (City $city) => isset($trips[$city->id]))
            ->each(function (City $city) use (&$trips) {
                $city->trips_count = $trips[$city->id]['total'] ?? 0;
                $city->trips_published_count = $trips[$city->id]['published'] ?? 0;
            })
            ->sortBy(City::titleField());

        return view('life.cities', [
            'cities' => $cities,
            'metaTitle' => __('Города'),
        ]);
    }

    public function city(City $city)
    {
        $trips = $city->trips()
            ->where('user_id', 1)
            ->withCount('photos')
            ->visible()
            ->get()
            ->groupBy(fn (Trip $model) => $model->year);

        $publishedTrips = $trips->where('status', Trip::STATUS_PUBLISHED);

        event(new \App\Events\Stats\CityViewed($city->id));

        if (1 === sizeof($publishedTrips)) {
            /** @var Trip $trip */
            $trip = $publishedTrips->first();

            return redirect($trip->www());
        }

        $city->loadCountry();

        \Breadcrumbs::push(__('Страны'), "life/countries")
            ->push($city->country->title, "life/countries/{$city->country->slug}")
            ->push($city->title);

        return view('life.city', [
            'city' => $city,
            'trips' => $trips,
            'metaTitle' => $city->metaTitle(),
            'metaDescription' => $city->metaDescription($trips),
        ]);
    }

    public function countries()
    {
        return view('life.countries', [
            'countries' => Country::allWithCitiesAndTrips(1),
            'metaTitle' => __('Страны'),
        ]);
    }

    public function country($slug)
    {
        $country = \CountryHelper::findBySlugOrFail($slug);

        $trips = $country->trips()
            ->where('user_id', 1)
            ->withCount('photos')
            ->visible()
            ->get()
            ->groupBy(fn (Trip $model) => $model->year);

        \Breadcrumbs::push($country->title, "life/countries/{$country->slug}");

        event(new \App\Events\Stats\CountryViewed($country->id));

        return view('life.country', [
            'trips' => $trips,
            'country' => $country,
            'metaTitle' => $country->metaTitle(),
            'metaDescription' => $country->metaDescription($trips),
        ]);
    }

    public function gig(Gig $gig)
    {
        $tpl = $gig->template();

        abort_unless(view()->exists($tpl), 404);

        \Breadcrumbs::push(__('Концерты'), 'life/gigs')
            ->push($gig->title);

        event(new \App\Events\Stats\GigViewed($gig->id));

        return view($tpl, [
            'gig' => $gig,
            'slug' => "gigs/{$gig->slug}", // Для собственных фотографий в тексте истории
            'timeline' => $gig->artistTimeline(),
            'metaImage' => $gig->meta_image,
            'metaTitle' => $gig->metaTitle(),
            'metaDescription' => $gig->metaDescription(),
        ]);
    }

    public function gigs()
    {
        $gigs = Gig::with('artist')
            ->orderByDesc('date')
            ->get()
            ->groupBy(fn (Gig $model) => $model->date->year);

        return view('life.gigs', [
            'gigs' => $gigs,
            'metaTitle' => trans('life.gigs_intro_title'),
        ]);
    }

    public function page(string $page)
    {
        if ($page === 'japanese') {
            return redirect(path(JapaneseController::class), 301);
        }

        $tpl = 'life.' . str_replace('.', '_', $page);

        if (view()->exists($tpl)) {
            return view($tpl, ['page' => $page]);
        }

        if ($trip = $this->getTrip($page)) {
            return $this->trip($trip);
        }

        if ($city = \CityHelper::findBySlug($page)) {
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

        \Breadcrumbs::push(__('Страны'), "life/countries")
            ->push($trip->city->country->title, "life/countries/{$trip->city->country->slug}")
            ->push($trip->city->title, "life/{$trip->city->slug}")
            ->push($trip->localizedDate());

        event(new \App\Events\Stats\TripViewed($trip->id));

        $nextTrips = $trip->next()->get();

        return view($tpl, [
            'trip' => $trip,
            'comments' => $trip->commentsPublished()->with('user')->orderBy('created_at')->get(),
            'timeline' => $trip->cityTimeline(),
            'metaImage' => $trip->metaImage(),
            'metaTitle' => $trip->metaTitle(),
            'nextTrips' => $nextTrips,
            'previousTrips' => $trip->previous($nextTrips->count())->get()->reverse(),
            'metaDescription' => $trip->metaDescription(),
        ]);
    }

    protected function getGig(string $slug): ?Gig
    {
        /** @var Gig $gig */
        $gig = Gig::where('slug', $slug)->first();

        return $gig;
    }

    protected function getTrip(string $slug): ?Trip
    {
        /** @var Trip $trip */
        $trip = Trip::where('user_id', 1)
            ->withCount('photos')
            ->where('slug', $slug)
            ->where('status', Trip::STATUS_PUBLISHED)
            ->first();

        return $trip;
    }
}
