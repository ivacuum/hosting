<?php namespace App\Http\Controllers;

use App\CacheKey;
use App\City;
use App\Country;
use App\Http\Requests\PhotosMapRequest;
use App\Photo;
use App\Tag;
use App\Trip;
use App\Utilities\CityHelper;
use App\Utilities\CountryHelper;
use Carbon\CarbonInterval;

class Photos extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:photos.index,photos');
        $this->middleware('breadcrumbs:photos.cities,photos/cities')->only('cities', 'city');
        $this->middleware('breadcrumbs:photos.countries,photos/countries')->only('countries', 'country');
        $this->middleware('breadcrumbs:photos.faq,photos/faq')->only('faq');
        $this->middleware('breadcrumbs:photos.map,photos/map')->only('map');
        $this->middleware('breadcrumbs:photos.tags,photos/tags')->only('tags');
        $this->middleware('breadcrumbs:photos.trips,photos/trips')->only('trip', 'trips');
    }

    public function index()
    {
        $photos = Photo::published()
            ->orderBy('id', 'desc')
            ->paginate(24)
            ->withPath(path([self::class, 'index']));

        return view($this->view, ['photos' => $photos]);
    }

    public function cities(CityHelper $cityHelper)
    {
        $trips = Trip::tripsByCities(1);

        $cities = $cityHelper->cachedById()
            ->filter(function (City $city) use (&$trips) {
                return $trips[$city->id]['published'] ?? 0;
            })
            ->sortBy(City::titleField());

        return view($this->view, ['cities' => $cities]);
    }

    public function city(string $slug, CityHelper $cityHelper)
    {
        /** @var City $city */
        $city = $cityHelper->findBySlugOrFail($slug);

        $ids = Trip::idsByCity($city->id);

        abort_if(empty($ids), 404);

        $photos = Photo::forTrips($ids)
            ->published()
            ->orderBy('id', 'desc')
            ->get();

        \Breadcrumbs::push($city->title);

        return view($this->view, [
            'city' => $city,
            'photos' => $photos,
            'metaTitle' => $city->title,
        ]);
    }

    public function countries()
    {
        return view($this->view, [
            'countries' => Country::allWithPublishedTrips(1),
        ]);
    }

    public function country(string $slug, CountryHelper $countryHelper)
    {
        /** @var Country $country */
        $country = $countryHelper->findBySlugOrFail($slug);

        $ids = Trip::idsByCountry($country->id);

        abort_if(empty($ids), 404);

        $photos = Photo::forTrips($ids)
            ->published()
            ->orderBy('id', 'desc')
            ->get();

        \Breadcrumbs::push($country->title);

        return view($this->view, [
            'photos' => $photos,
            'country' => $country,
            'metaTitle' => $country->title,
        ]);
    }

    public function faq()
    {
        return view($this->view);
    }

    public function map(PhotosMapRequest $request)
    {
        if ($request->expectsJson()) {
            return $this->pointsForMap($request->tripId());
        }

        $photoSlug = $request->photoSlug();

        $photo = $photoSlug
            ? Photo::query()
                ->where('slug', $photoSlug)
                ->where('status', Photo::STATUS_PUBLISHED)
                ->first()
            : null;

        return view($this->view, ['photo' => $photo]);
    }

    public function show(Photo $photo)
    {
        abort_unless($photo->status === Photo::STATUS_PUBLISHED, 404);

        $photo->load('rel', 'tags');
        $photo->rel->loadCityAndCountry();

        $tagId = request('tag_id');
        $cityId = request('city_id');
        $tripId = request('trip_id');
        $countryId = request('country_id');

        $next = Photo::where('id', '>', $photo->id)->published();
        $prev = Photo::where('id', '<', $photo->id)->published()->orderBy('id', 'desc');

        if ($tagId) {
            // Просмотр в пределах одного тэга
            $next = $next->whereHas('tags', function ($query) use ($tagId) {
                $query->where('tag_id', $tagId);
            });

            $prev = $prev->whereHas('tags', function ($query) use ($tagId) {
                $query->where('tag_id', $tagId);
            });
        } elseif ($cityId) {
            // В пределах города
            abort_unless($cityId == $photo->rel->city->id, 404);

            $ids = Trip::idsByCity($cityId);

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

            $ids = Trip::idsByCountry($countryId);

            $next = $next->forTrips($ids);
            $prev = $prev->forTrips($ids);
        }

        event(new \App\Events\Stats\PhotoViewed($photo->id));

        if ($tagId) {
            $tag = Tag::findOrFail($tagId);

            \Breadcrumbs::push(trans('photos.tags'), 'photos/tags')
                ->push($tag->breadcrumb(), "photos/tags/{$tagId}");
        } elseif ($cityId) {
            \Breadcrumbs::push(trans('photos.cities'), 'photos/cities')
                ->push($photo->rel->city->breadcrumb(), "photos/cities/{$photo->rel->city->slug}");
        } elseif ($tripId) {
            \Breadcrumbs::push(trans('photos.trips'), 'photos/trips')
                ->push($photo->rel->breadcrumb(), "photos/trips/{$tripId}");
        } elseif ($countryId) {
            \Breadcrumbs::push(trans('photos.countries'), 'photos/countries')
                ->push($photo->rel->city->country->breadcrumb(), "photos/countries/{$photo->rel->city->country->slug}");
        }

        \Breadcrumbs::push(trans('photos.show'));

        return view($this->view, [
            'next' => $next->first(),
            'prev' => $prev->first(),
            'photo' => $photo,
            'tagId' => $tagId,
            'cityId' => $cityId,
            'tripId' => $tripId,
            'countryId' => $countryId,
            'metaTitle' => "{$photo->rel->title}, {$photo->rel->period} {$photo->rel->year}",
        ]);
    }

    public function tag(Tag $tag)
    {
        $photos = Photo::forTag($tag->id)
            ->published()
            ->orderBy('id', 'desc')
            ->get();

        \Breadcrumbs::push(trans('photos.tags'), 'photos/tags')
            ->push($tag->breadcrumb());

        event(new \App\Events\Stats\TagViewed($tag->id));

        return view($this->view, [
            'tag' => $tag,
            'photos' => $photos,
            'metaTitle' => "#{$tag->title} · " . \ViewHelper::plural('photos', sizeof($tag->photos)),
        ]);
    }

    public function tags()
    {
        // Тэги с фотками
        $tagIds = \DB::table('taggable')
            ->select('tag_id')
            ->where('rel_type', 'Photo')
            ->distinct()
            ->get()
            ->pluck('tag_id');

        $tags = Tag::withCount('photosPublished')
            ->whereIn('id', $tagIds)
            ->orderBy(Tag::titleField())
            ->get();

        return view($this->view, ['tags' => $tags]);
    }

    public function trip(Trip $trip)
    {
        abort_unless($trip->isPublished(), 404);

        $photos = Photo::forTrip($trip->id)
            ->published()
            ->orderBy('id', 'desc')
            ->get();

        \Breadcrumbs::push($trip->title);

        return view($this->view, [
            'trip' => $trip,
            'photos' => $photos,
        ]);
    }

    public function trips()
    {
        return view($this->view, [
            'trips' => Trip::tripswithCover(),
        ]);
    }

    protected function pointsForMap($tripId)
    {
        // Кэширование отключено при фильтре по поездке
        $cacheEntry = $tripId ? CacheKey::PHOTOS_POINTS_FOR_TRIP : CacheKey::PHOTOS_POINTS;
        $minutes = $tripId ? 0 : 30;

        return \Cache::remember($cacheEntry, CarbonInterval::minutes($minutes), function () use ($tripId) {
            $photos = Photo::with('rel')
                ->forTrip($tripId)
                ->published()
                ->onMap()
                ->orderBy('id')
                ->get();

            $collection = [
                'type' => 'FeatureCollection',
                'features' => [],
            ];

            /** @var Photo $photo */
            foreach ($photos as $i => $photo) {
                $basename = basename($photo->slug);

                $collection['features'][] = [
                    'type' => 'Feature',
                    'id' => $i,
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [$photo->lat, $photo->lon],
                    ],
                    'properties' => [
                        'balloonContent' => sprintf('<div><a href="%s#%s">%s, %s %s<br><img class="mt-1 image-200 object-cover rounded" src="%s" alt=""></a></div>', $photo->rel->www(), $basename, $photo->rel->title, $photo->rel->period, $photo->rel->year, $photo->thumbnailUrl()),
                        'clusterCaption' => $basename,
                    ],
                ];
            }

            return $collection;
        });
    }
}
