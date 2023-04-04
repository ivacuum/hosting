<?php namespace App\Http\Controllers;

use App\Action\GetMyVisibleGigsAction;
use App\Action\GetMyVisibleTripsAction;
use App\Action\GetTripCountByCitiesAction;
use App\City;
use App\Country;
use App\Domain\TripStatus;
use App\Gig;
use App\Http\Requests\LifeIndexForm;
use App\Scope\TripNextScope;
use App\Scope\TripOfAdminScope;
use App\Scope\TripPreviousScope;
use App\Scope\TripPublishedScope;
use App\Scope\TripVisibleScope;
use App\Trip;
use App\Utilities\CityHelper;

class Life
{
    public function index(
        LifeIndexForm $request,
        GetMyVisibleTripsAction $getMyVisibleTrips,
        GetMyVisibleGigsAction $getMyVisibleGigs
    ) {
        if ($request->shouldRedirectInstagrammer()) {
            return $request->redirectInstagrammer();
        }

        $trips = $getMyVisibleTrips->execute($request->from, $request->to);
        $gigs = $getMyVisibleGigs->execute($request->from, $request->to);

        $models = collect([...$trips, ...$gigs])
            ->sortByDesc(fn (Gig|Trip $model) => $model->date())
            ->groupBy(fn (Gig|Trip $model) => $model->year);

        return view('life.index', [
            'modelsByYears' => $models,
        ]);
    }

    public function cities(GetTripCountByCitiesAction $getTripCountByCities)
    {
        $tripCount = $getTripCountByCities->execute(1);

        $cities = \CityHelper::cachedById()
            ->filter(fn (City $city) => isset($tripCount[$city->id]))
            ->each(function (City $city) use (&$tripCount) {
                $city->trips_count = $tripCount[$city->id]['total'] ?? 0;
                $city->trips_published_count = $tripCount[$city->id]['published'] ?? 0;
            })
            ->sortBy(City::titleField());

        return view('life.cities', [
            'cities' => $cities,
        ]);
    }

    public function city(City $city)
    {
        $trips = $city->trips()
            ->withCount('photos')
            ->tap(new TripOfAdminScope)
            ->tap(new TripVisibleScope)
            ->get()
            ->groupBy(fn (Trip $model) => $model->year);

        $publishedTrips = $trips->where('status', TripStatus::Published);

        event(new \App\Events\Stats\CityViewed($city->id));

        if ($publishedTrips->containsOneItem()) {
            /** @var Trip $trip */
            $trip = $publishedTrips->first();

            return redirect($trip->www());
        }

        $city->loadCountry();

        \Breadcrumbs::push(__('Страны'), 'life/countries')
            ->push($city->country->title, "life/countries/{$city->country->slug}")
            ->push($city->title);

        return view('life.city', [
            'city' => $city,
            'metaTitle' => $city->metaTitle(),
            'modelsByYears' => $trips,
            'metaDescription' => $city->metaDescription($trips),
        ]);
    }

    public function countries()
    {
        return view('life.countries', [
            'countries' => Country::allWithCitiesAndTrips(1),
        ]);
    }

    public function country($slug)
    {
        $country = \CountryHelper::findBySlugOrFail($slug);

        $trips = $country->trips()
            ->withCount('photos')
            ->tap(new TripOfAdminScope)
            ->tap(new TripVisibleScope)
            ->get()
            ->groupBy(fn (Trip $model) => $model->year);

        \Breadcrumbs::push($country->title, "life/countries/{$country->slug}");

        event(new \App\Events\Stats\CountryViewed($country->id));

        return view('life.country', [
            'country' => $country,
            'metaTitle' => $country->metaTitle(),
            'modelsByYears' => $trips,
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
        ]);
    }

    public function page(CityHelper $cityHelper, string $page)
    {
        if ($page === 'japanese') {
            return redirect(to('japanese'), 301);
        }

        $tpl = 'life.' . str_replace('.', '_', $page);

        if (view()->exists($tpl)) {
            return view($tpl, ['page' => $page]);
        }

        if ($trip = $this->getTrip($page)) {
            return $this->trip($trip);
        }

        if ($city = $cityHelper->findBySlug($page)) {
            return $this->city($city);
        }

        if ($gig = $this->getGig($page)) {
            return $this->gig($gig);
        }

        abort(404);
    }

    public function trip(Trip $trip)
    {
        $tpl = $trip->template();

        abort_unless(view()->exists($tpl), 404);

        $trip->loadCityAndCountry();

        \Breadcrumbs::push(__('Страны'), 'life/countries')
            ->push($trip->city->country->title, "life/countries/{$trip->city->country->slug}")
            ->push($trip->city->title, "life/{$trip->city->slug}")
            ->push($trip->localizedDate());

        event(new \App\Events\Stats\TripViewed($trip->id));

        $nextTrips = $trip->tap(new TripNextScope($trip))->get();

        return view($tpl, [
            'trip' => $trip,
            'comments' => true,
            'timeline' => $trip->cityTimeline(),
            'metaImage' => $trip->metaImage(),
            'metaTitle' => $trip->metaTitle(),
            'nextTrips' => $nextTrips,
            'previousTrips' => $trip->tap(new TripPreviousScope($trip, $nextTrips->count()))
                ->get()
                ->reverse(),
            'metaDescription' => $trip->metaDescription(),
        ]);
    }

    protected function getGig(string $slug): ?Gig
    {
        return Gig::firstWhere('slug', $slug);
    }

    protected function getTrip(string $slug): ?Trip
    {
        return Trip::withCount('photos')
            ->where('slug', $slug)
            ->tap(new TripOfAdminScope)
            ->tap(new TripPublishedScope)
            ->first();
    }
}
