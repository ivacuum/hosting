<?php

namespace App\Http\Controllers;

use App\Domain\Life\Action\GetMyVisibleGigsAction;
use App\Domain\Life\Action\GetMyVisibleTripsAction;
use App\Domain\Life\Action\GetTripCountByCitiesAction;
use App\Domain\Life\Models\City;
use App\Domain\Life\Models\Country;
use App\Domain\Life\Models\Gig;
use App\Domain\Life\Models\Trip;
use App\Domain\Life\Scope\TripNextScope;
use App\Domain\Life\Scope\TripOfAdminScope;
use App\Domain\Life\Scope\TripPreviousScope;
use App\Domain\Life\Scope\TripPublishedScope;
use App\Domain\Life\Scope\TripVisibleScope;
use App\Domain\Life\TripStatus;
use App\Http\Requests\LifeIndexForm;
use App\Utilities\CityHelper;
use Laravel\Head\Enums\OgType;
use Laravel\Head\HeadManager;

class LifeController
{
    public function index(
        LifeIndexForm $request,
        GetMyVisibleTripsAction $getMyVisibleTrips,
        GetMyVisibleGigsAction $getMyVisibleGigs,
        HeadManager $head,
    ) {
        $trips = $getMyVisibleTrips->execute($request->from, $request->to);
        $gigs = $getMyVisibleGigs->execute($request->from, $request->to);

        $models = collect([...$trips, ...$gigs])
            ->sortByDesc(static fn (Gig|Trip $model) => $model->date())
            ->groupBy(static fn (Gig|Trip $model) => $model->year);

        $head->feed(url(to('life/rss')), __('Заметки'));

        return view('life.index', [
            'modelsByYears' => $models,
        ]);
    }

    public function cities(GetTripCountByCitiesAction $getTripCountByCities)
    {
        $tripCount = $getTripCountByCities->execute(1);

        $cities = \CityHelper::cachedById()
            ->filter(static fn (City $city) => isset($tripCount[$city->id]))
            ->each(static function (City $city) use (&$tripCount) {
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
            ->get();

        $publishedTrips = $trips->where('status', TripStatus::Published);

        event(new \App\Events\Stats\CityViewed($city->id));

        if ($publishedTrips->containsOneItem()) {
            /** @var Trip $trip */
            $trip = $publishedTrips->first();

            return redirect($trip->www());
        }

        $trips = $trips->groupBy(static fn (Trip $model) => $model->year);

        $city->loadCountry();

        \Breadcrumbs::push(__('Страны'), 'life/countries')
            ->push($city->country->title, "life/countries/{$city->country->slug}")
            ->push($city->title);

        \Head::title($city->metaTitle())
            ->description($city->metaDescription($trips))
            ->og(
                type: OgType::Article,
            );

        return view('life.city', [
            'city' => $city,
            'modelsByYears' => $trips,
        ]);
    }

    public function countries()
    {
        return view('life.countries', [
            'countries' => Country::allWithCitiesAndTrips(1),
        ]);
    }

    public function country(Country $country)
    {
        $trips = $country->trips()
            ->withCount('photos')
            ->tap(new TripOfAdminScope)
            ->tap(new TripVisibleScope)
            ->get()
            ->groupBy(static fn (Trip $model) => $model->year);

        \Breadcrumbs::push($country->title, "life/countries/{$country->slug}");

        event(new \App\Events\Stats\CountryViewed($country->id));

        \Head::title($country->metaTitle())
            ->description($country->metaDescription($trips))
            ->og(
                type: OgType::Article,
            );

        return view('life.country', [
            'country' => $country,
            'modelsByYears' => $trips,
        ]);
    }

    public function gig(Gig $gig)
    {
        $tpl = $gig->template();

        abort_unless(view()->exists($tpl), 404);

        \Breadcrumbs::push(__('Концерты'), 'life/gigs')
            ->push($gig->title);

        event(new \App\Events\Stats\GigViewed($gig->id));

        \Head::title($gig->metaTitle())
            ->description($gig->metaDescription())
            ->og(
                type: OgType::Article,
                image: $gig->meta_image ?: null,
            );

        return view($tpl, [
            'gig' => $gig,
            'slug' => "gigs/{$gig->slug}", // Для собственных фотографий в тексте истории
            'timeline' => $gig->artistTimeline(),
        ]);
    }

    public function gigs(HeadManager $head)
    {
        $gigs = Gig::query()
            ->with('artist')
            ->orderByDesc('date')
            ->get()
            ->groupBy(static fn (Gig $model) => $model->date->year);

        $head->feed(url(to('life/gigs/rss')), __('Концерты'));

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

        \Head::title($trip->metaTitle())
            ->description($trip->metaDescription())
            ->og(
                type: OgType::Article,
                image: $trip->metaImage() ?: null,
            );

        return view($tpl, [
            'trip' => $trip,
            'comments' => true,
            'timeline' => $trip->cityTimeline(),
            'nextTrips' => $nextTrips,
            'previousTrips' => $trip->tap(new TripPreviousScope($trip, $nextTrips->count()))
                ->get()
                ->reverse(),
        ]);
    }

    protected function getGig(string $slug): Gig|null
    {
        return Gig::query()->firstWhere('slug', $slug);
    }

    protected function getTrip(string $slug): Trip|null
    {
        return Trip::query()
            ->withCount('photos')
            ->where('slug', $slug)
            ->tap(new TripOfAdminScope)
            ->tap(new TripPublishedScope)
            ->first();
    }
}
