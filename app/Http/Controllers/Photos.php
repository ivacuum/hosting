<?php namespace App\Http\Controllers;

use App\CacheKey;
use App\City;
use App\Country;
use App\Photo;
use App\Tag;
use App\Trip;

class Photos extends Controller
{
    public function index()
    {
        $photos = Photo::published()
            ->orderBy('id', 'desc')
            ->paginate(24)
            ->withPath(path("{$this->class}@index"));

        return view($this->view, compact('photos'));
    }

    public function cities()
    {
        $trips = Trip::tripsByCities(1);

        $cities = \CityHelper::cachedById()
            ->filter(function ($city) use (&$trips) {
                return $trips[$city->id]['published'] ?? 0;
            })
            ->sortBy(City::titleField());

        return view($this->view, compact('cities'));
    }

    public function city($slug)
    {
        $city = \CityHelper::findBySlugOrFail($slug);

        $ids = Trip::idsByCity($city->id);

        abort_if(empty($ids), 404);

        $photos = Photo::forTrips($ids)
            ->published()
            ->orderBy('id', 'desc')
            ->get();

        \Breadcrumbs::push($city->title);

        $meta_title = $city->title;

        return view($this->view, compact('city', 'meta_title', 'photos'));
    }

    public function countries()
    {
        $countries = Country::allWithPublishedTrips(1);

        return view($this->view, compact('countries'));
    }

    public function country($slug)
    {
        $country = \CountryHelper::findBySlugOrFail($slug);

        $ids = Trip::idsByCountry($country->id);

        abort_if(empty($ids), 404);

        $photos = Photo::forTrips($ids)
            ->published()
            ->orderBy('id', 'desc')
            ->get();

        \Breadcrumbs::push($country->title);

        $meta_title = $country->title;

        return view($this->view, compact('country', 'meta_title', 'photos'));
    }

    public function faq()
    {
        return view($this->view);
    }

    public function map()
    {
        if (request()->ajax()) {
            $tripId = request('trip_id');

            return $this->pointsForMap($tripId);
        }

        $photoSlug = request('photo');

        $photo = $photoSlug
            ? Photo::query()
                ->where('slug', $photoSlug)
                ->where('status', Photo::STATUS_PUBLISHED)
                ->first()
            : null;

        return view($this->view, compact('photo'));
    }

    public function show(Photo $photo)
    {
        abort_unless($photo->status === Photo::STATUS_PUBLISHED, 404);

        $photo->load('rel', 'tags');
        $photo->rel->loadCityAndCountry();

        $tag_id = request('tag_id');
        $city_id = request('city_id');
        $trip_id = request('trip_id');
        $country_id = request('country_id');

        $next = Photo::where('id', '>', $photo->id)->published();
        $prev = Photo::where('id', '<', $photo->id)->published()->orderBy('id', 'desc');

        if ($tag_id) {
            // Просмотр в пределах одного тэга
            $next = $next->whereHas('tags', function ($query) use ($tag_id) {
                $query->where('tag_id', $tag_id);
            });

            $prev = $prev->whereHas('tags', function ($query) use ($tag_id) {
                $query->where('tag_id', $tag_id);
            });
        } elseif ($city_id) {
            // В пределах города
            abort_unless($city_id == $photo->rel->city->id, 404);

            $ids = Trip::idsByCity($city_id);

            $next = $next->forTrips($ids);
            $prev = $prev->forTrips($ids);
        } elseif ($trip_id) {
            // В пределах поездки
            abort_unless($trip_id == $photo->rel_id, 404);

            $next = $next->forTrip($trip_id);
            $prev = $prev->forTrip($trip_id);
        } elseif ($country_id) {
            // В пределах страны
            abort_unless($country_id == $photo->rel->city->country->id, 404);

            $ids = Trip::idsByCountry($country_id);

            $next = $next->forTrips($ids);
            $prev = $prev->forTrips($ids);
        }

        $next = $next->first();
        $prev = $prev->first();

        event(new \App\Events\Stats\PhotoViewed($photo->id));

        if ($tag_id) {
            $tag = Tag::findOrFail($tag_id);

            \Breadcrumbs::push(trans('photos.tags'), 'photos/tags')
                ->push($tag->breadcrumb(), "photos/tags/{$tag_id}");
        } elseif ($city_id) {
            \Breadcrumbs::push(trans('photos.cities'), 'photos/cities')
                ->push($photo->rel->city->breadcrumb(), "photos/cities/{$photo->rel->city->slug}");
        } elseif ($trip_id) {
            \Breadcrumbs::push(trans('photos.trips'), 'photos/trips')
                ->push($photo->rel->breadcrumb(), "photos/trips/{$trip_id}");
        } elseif ($country_id) {
            \Breadcrumbs::push(trans('photos.countries'), 'photos/countries')
                ->push($photo->rel->city->country->breadcrumb(), "photos/countries/{$photo->rel->city->country->slug}");
        }

        \Breadcrumbs::push(trans('photos.show'));

        $meta_title = "{$photo->rel->title}, {$photo->rel->period} {$photo->rel->year}";

        return view($this->view, compact('city_id', 'country_id', 'meta_title', 'next', 'photo', 'prev', 'tag_id', 'trip_id'));
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

        $meta_title = "#{$tag->title} · ".\ViewHelper::plural('photos', sizeof($tag->photos));

        return view($this->view, compact('meta_title', 'photos', 'tag'));
    }

    public function tags()
    {
        \Breadcrumbs::push(trans('photos.tags'));

        // Тэги с фотками
        $tags_ids = \DB::table('taggable')
            ->select('tag_id')
            ->where('rel_type', 'Photo')
            ->distinct()
            ->get()
            ->pluck('tag_id');

        $tags = Tag::withCount('photosPublished')
            ->whereIn('id', $tags_ids)
            ->orderBy(Tag::titleField())
            ->get();

        return view($this->view, compact('tags'));
    }

    public function trip(Trip $trip)
    {
        abort_unless($trip->status === Trip::STATUS_PUBLISHED, 404);

        $photos = Photo::forTrip($trip->id)
            ->published()
            ->orderBy('id', 'desc')
            ->get();

        \Breadcrumbs::push($trip->title);

        return view($this->view, compact('photos', 'trip'));
    }

    public function trips()
    {
        $trips = Trip::tripswithCover();

        return view($this->view, compact('trips'));
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:photos.index,photos');
        $this->middleware('breadcrumbs:photos.cities,photos/cities')->only('cities', 'city');
        $this->middleware('breadcrumbs:photos.countries,photos/countries')->only('countries', 'country');
        $this->middleware('breadcrumbs:photos.faq,photos/faq')->only('faq');
        $this->middleware('breadcrumbs:photos.map,photos/map')->only('map');
        $this->middleware('breadcrumbs:photos.trips,photos/trips')->only('trip', 'trips');
    }

    protected function pointsForMap($tripId)
    {
        // Кэширование отключено при фильтре по поездке
        $cacheEntry = $tripId ? CacheKey::PHOTOS_POINTS_FOR_TRIP : CacheKey::PHOTOS_POINTS;
        $minutes = $tripId ? 0 : 30;

        return \Cache::remember($cacheEntry, now()->addMinutes($minutes), function () use ($tripId) {
            $photos = Photo::with('rel')
                ->forTrip($tripId)
                ->published()
                ->onMap()
                ->orderBy('id', 'asc')
                ->get();

            $collection = [
                'type' => 'FeatureCollection',
                'features' => [],
            ];

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
                        'balloonContent' => sprintf('<div><a href="%s#%s">%s, %s %s<br><img class="mt-1 image-200 object-cover rounded" src="%s"></a></div>', $photo->rel->www(), $basename, $photo->rel->title, $photo->rel->period, $photo->rel->year, $photo->thumbnailUrl()),
                        'clusterCaption' => $basename,
                    ],
                ];
            }

            return $collection;
        });
    }
}
