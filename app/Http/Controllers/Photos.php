<?php namespace App\Http\Controllers;

use App\Action\GetPhotoPointsAction;
use App\Action\GetTripCountByCitiesAction;
use App\Action\GetTripsPublishedByCityAction;
use App\Action\GetTripsPublishedByCountryAction;
use App\Action\GetTripsPublishedWithCoverAction;
use App\City;
use App\Country;
use App\Domain\PhotoStatus;
use App\Http\Requests\PhotosMapForm;
use App\Photo;
use App\Tag;
use App\Trip;
use App\Utilities\CityHelper;
use App\Utilities\CountryHelper;

class Photos extends Controller
{
    public function index()
    {
        $photos = Photo::query()
            ->published()
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

        $photos = Photo::forTrips($ids)
            ->published()
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

        $photos = Photo::forTrips($ids)
            ->published()
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
            return $getPhotoPoints->execute($request->tripId());
        }

        $photoSlug = $request->photoSlug();

        $photo = $photoSlug
            ? Photo::query()
                ->where('slug', $photoSlug)
                ->where('status', PhotoStatus::Published)
                ->first()
            : null;

        return view('photos.map', ['photo' => $photo]);
    }

    public function show(Photo $photo, GetTripsPublishedByCityAction $getTripsPublishedByCity, GetTripsPublishedByCountryAction $getTripsPublishedByCountry)
    {
        abort_unless($photo->isPublished(), 404);

        $photo->load('rel', 'tags');
        $photo->rel->loadCityAndCountry();

        $tagId = request('tag_id');
        $cityId = request('city_id');
        $tripId = request('trip_id');
        $countryId = request('country_id');

        $next = Photo::where('id', '>', $photo->id)->published();
        $prev = Photo::where('id', '<', $photo->id)->published()->orderByDesc('id');

        if ($tagId) {
            // Просмотр в пределах одного тэга
            $next = $next->whereRelation('tags', 'tag_id', $tagId);
            $prev = $prev->whereRelation('tags', 'tag_id', $tagId);
        } elseif ($cityId) {
            // В пределах города
            abort_unless($cityId == $photo->rel->city->id, 404);

            $ids = $getTripsPublishedByCity->execute($cityId);

            $next = $next->forTrips($ids);
            $prev = $prev->forTrips($ids);
        } elseif ($tripId) {
            // В пределах поездки
            abort_unless($tripId == $photo->rel_id, 404);

            $next = $next->forTrip($tripId);
            $prev = $prev->forTrip($tripId);
        } elseif ($countryId) {
            // В пределах страны
            abort_unless($countryId == $photo->rel->city->country->id, 404);

            $ids = $getTripsPublishedByCountry->execute($countryId);

            $next = $next->forTrips($ids);
            $prev = $prev->forTrips($ids);
        }

        event(new \App\Events\Stats\PhotoViewed($photo->id));

        if ($tagId) {
            $tag = Tag::findOrFail($tagId);

            \Breadcrumbs::push(__('Тэги'), 'photos/tags')
                ->push($tag->breadcrumb(), "photos/tags/{$tagId}");
        } elseif ($cityId) {
            \Breadcrumbs::push(__('Города'), 'photos/cities')
                ->push($photo->rel->city->breadcrumb(), "photos/cities/{$photo->rel->city->slug}");
        } elseif ($tripId) {
            \Breadcrumbs::push(__('Поездки'), 'photos/trips')
                ->push($photo->rel->breadcrumb(), "photos/trips/{$tripId}");
        } elseif ($countryId) {
            \Breadcrumbs::push(__('Страны'), 'photos/countries')
                ->push($photo->rel->city->country->breadcrumb(), "photos/countries/{$photo->rel->city->country->slug}");
        }

        \Breadcrumbs::push(__('Просмотр фотографии'));

        return view('photos.show', [
            'next' => $next->first(),
            'prev' => $prev->first(),
            'photo' => $photo,
            'tagId' => $tagId,
            'cityId' => $cityId,
            'tripId' => $tripId,
            'countryId' => $countryId,
            'metaTitle' => "{$photo->rel->title}, {$photo->rel->period()} {$photo->rel->year}",
        ]);
    }

    public function tag(Tag $tag)
    {
        $photos = Photo::forTag($tag->id)
            ->published()
            ->orderByDesc('id')
            ->get();

        \Breadcrumbs::push($tag->breadcrumb());

        event(new \App\Events\Stats\TagViewed($tag->id));

        return view('photos.tag', [
            'tag' => $tag,
            'photos' => $photos,
            'metaTitle' => "#{$tag->title} · " . \ViewHelper::plural('photos', sizeof($tag->photos)),
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
            ->forTrip($trip->id)
            ->published()
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
