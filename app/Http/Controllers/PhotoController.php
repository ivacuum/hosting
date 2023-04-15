<?php namespace App\Http\Controllers;

use App\Action\GetPhotoPointsAction;
use App\Action\GetTripCountByCitiesAction;
use App\Action\GetTripsPublishedByCityAction;
use App\Action\GetTripsPublishedByCountryAction;
use App\Action\GetTripsPublishedWithCoverAction;
use App\City;
use App\Country;
use App\Http\Requests\PhotoShowForm;
use App\Http\Requests\PhotosMapForm;
use App\Photo;
use App\Scope\PhotoForTagScope;
use App\Scope\PhotoForTripScope;
use App\Scope\PhotoForTripsScope;
use App\Scope\PhotoPublishedScope;
use App\Tag;
use App\Trip;
use App\Utilities\CityHelper;
use App\Utilities\CountryHelper;

class PhotoController
{
    public function index()
    {
        $photos = Photo::query()
            ->tap(new PhotoPublishedScope)
            ->orderByDesc('id')
            ->paginate(24);

        return view('photos.index', ['photos' => $photos]);
    }

    public function cities(CityHelper $cityHelper, GetTripCountByCitiesAction $getTripCountByCities)
    {
        $tripCount = $getTripCountByCities->execute(1);

        $cities = $cityHelper->cachedById()
            ->filter(fn (City $city) => $tripCount[$city->id]['published'] ?? 0)
            ->sortBy(City::titleField());

        return view('photos.cities', ['cities' => $cities]);
    }

    public function city(string $slug, CityHelper $cityHelper, GetTripsPublishedByCityAction $getTripsPublishedByCity)
    {
        /** @var City $city */
        $city = $cityHelper->findBySlugOrFail($slug);
        $city->loadCountry();

        $ids = $getTripsPublishedByCity->execute($city->id);

        abort_if(empty($ids), 404);

        $photos = Photo::query()
            ->tap(new PhotoForTripsScope($ids))
            ->tap(new PhotoPublishedScope)
            ->orderByDesc('id')
            ->get();

        \Breadcrumbs::push($city->breadcrumb());

        return view('photos.city', [
            'city' => $city,
            'photos' => $photos,
            'metaTitle' => $city->title,
        ]);
    }

    public function countries()
    {
        return view('photos.countries', [
            'countries' => Country::allWithPublishedTrips(1),
        ]);
    }

    public function country(string $slug, CountryHelper $countryHelper, GetTripsPublishedByCountryAction $getTripsPublishedByCountry)
    {
        /** @var Country $country */
        $country = $countryHelper->findBySlugOrFail($slug);

        $ids = $getTripsPublishedByCountry->execute($country->id);

        abort_if(empty($ids), 404);

        $photos = Photo::query()
            ->tap(new PhotoForTripsScope($ids))
            ->tap(new PhotoPublishedScope)
            ->orderByDesc('id')
            ->get();

        \Breadcrumbs::push($country->breadcrumb());

        return view('photos.country', [
            'photos' => $photos,
            'country' => $country,
            'metaTitle' => $country->title,
        ]);
    }

    public function map(PhotosMapForm $request, GetPhotoPointsAction $getPhotoPoints)
    {
        if ($request->expectsJson()) {
            return $getPhotoPoints->execute($request->tripId);
        }

        return view('photos.map', ['photo' => $request->photo]);
    }

    public function show(
        PhotoShowForm $request,
        Photo $photo,
        GetTripsPublishedByCityAction $getTripsPublishedByCity,
        GetTripsPublishedByCountryAction $getTripsPublishedByCountry
    ) {
        abort_unless($photo->isPublished(), 404);

        $photo->load('rel', 'tags');
        $photo->rel->loadCityAndCountry();

        $next = Photo::where('id', '>', $photo->id)->tap(new PhotoPublishedScope);
        $prev = Photo::where('id', '<', $photo->id)->tap(new PhotoPublishedScope)->orderByDesc('id');

        if ($request->tagId) {
            // Просмотр в пределах одного тэга
            $next = $next->whereRelation('tags', 'tag_id', $request->tagId);
            $prev = $prev->whereRelation('tags', 'tag_id', $request->tagId);
        } elseif ($request->cityId) {
            // В пределах города
            abort_unless($request->cityId == $photo->rel->city->id, 404);

            $ids = $getTripsPublishedByCity->execute($request->cityId);

            $next = $next->tap(new PhotoForTripsScope($ids));
            $prev = $prev->tap(new PhotoForTripsScope($ids));
        } elseif ($request->tripId) {
            // В пределах поездки
            abort_unless($request->tripId == $photo->rel_id, 404);

            $next = $next->tap(new PhotoForTripScope($request->tripId));
            $prev = $prev->tap(new PhotoForTripScope($request->tripId));
        } elseif ($request->countryId) {
            // В пределах страны
            abort_unless($request->countryId == $photo->rel->city->country->id, 404);

            $ids = $getTripsPublishedByCountry->execute($request->countryId);

            $next = $next->tap(new PhotoForTripsScope($ids));
            $prev = $prev->tap(new PhotoForTripsScope($ids));
        }

        if ($request->tagId) {
            $tag = Tag::findOrFail($request->tagId);

            \Breadcrumbs::push(__('Тэги'), 'photos/tags')
                ->push($tag->breadcrumb(), "photos/tags/{$request->tagId}");
        } elseif ($request->cityId) {
            \Breadcrumbs::push(__('Города'), 'photos/cities')
                ->push($photo->rel->city->breadcrumb(), "photos/cities/{$photo->rel->city->slug}");
        } elseif ($request->tripId) {
            \Breadcrumbs::push(__('Поездки'), 'photos/trips')
                ->push($photo->rel->breadcrumb(), "photos/trips/{$request->tripId}");
        } elseif ($request->countryId) {
            \Breadcrumbs::push(__('Страны'), 'photos/countries')
                ->push($photo->rel->city->country->breadcrumb(), "photos/countries/{$photo->rel->city->country->slug}");
        }

        \Breadcrumbs::push(__('Просмотр фотографии'));

        return view('photos.show', [
            'next' => $next->first(),
            'prev' => $prev->first(),
            'photo' => $photo,
            'tagId' => $request->tagId,
            'cityId' => $request->cityId,
            'tripId' => $request->tripId,
            'countryId' => $request->countryId,
            'metaTitle' => "{$photo->rel->title}, {$photo->rel->period()} {$photo->rel->year}",
        ]);
    }

    public function tag(Tag $tag)
    {
        $photos = Photo::query()
            ->tap(new PhotoForTagScope($tag->id))
            ->tap(new PhotoPublishedScope)
            ->orderByDesc('id')
            ->get();

        \Breadcrumbs::push($tag->breadcrumb());

        event(new \App\Events\Stats\TagViewed($tag->id));

        return view('photos.tag', [
            'tag' => $tag,
            'photos' => $photos,
            'metaTitle' => "#{$tag->title} · " . \ViewHelper::plural('photos', count($tag->photos)),
        ]);
    }

    public function tags()
    {
        // Тэги с фотками
        $tagIds = \DB::table('taggable')
            ->where('rel_type', (new Photo)->getMorphClass())
            ->distinct()
            ->pluck('tag_id');

        $tags = Tag::withCount('photosPublished')
            ->whereIn('id', $tagIds)
            ->orderBy(Tag::titleField())
            ->get();

        return view('photos.tags', ['tags' => $tags]);
    }

    public function trip(Trip $trip)
    {
        abort_unless($trip->status->isPublished(), 404);

        $photos = Photo::query()
            ->tap(new PhotoForTripScope($trip->id))
            ->tap(new PhotoPublishedScope)
            ->orderByDesc('id')
            ->get();

        \Breadcrumbs::push($trip->breadcrumb());

        return view('photos.trip', [
            'trip' => $trip,
            'photos' => $photos,
        ]);
    }

    public function trips(GetTripsPublishedWithCoverAction $getTripsPublishedWithCover)
    {
        return view('photos.trips', [
            'trips' => $getTripsPublishedWithCover->execute(),
        ]);
    }
}
