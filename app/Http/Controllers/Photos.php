<?php namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Photo;
use App\Tag;
use App\Trip;

class Photos extends Controller
{
    public function index()
    {
        \Breadcrumbs::push(trans('photos.index'));

        $photos = Photo::orderBy('id', 'desc')->paginate(20);

        return view($this->view, compact('photos'));
    }

    public function cities()
    {
        \Breadcrumbs::push(trans('photos.index'), 'photos');
        \Breadcrumbs::push(trans('photos.cities'));

        $cities = City::orderBy(City::titleField())->get();

        $trips_by_cities = [];

        Trip::published()
            ->get(['id', 'city_id', 'status'])
            ->each(function ($trip) use (&$trips_by_cities) {
                @$trips_by_cities[$trip->city_id] += 1;
            });

        $cities = $cities->filter(function ($city) use (&$trips_by_cities) {
            return $trips_by_cities[$city->id] ?? 0;
        });

        return view($this->view, compact('cities'));
    }

    public function city($slug)
    {
        $city = City::where('slug', $slug)->firstOrFail();

        $ids = Trip::idsByCity($city->id);

        abort_if(empty($ids), 404);

        $photos = Photo::forTrips($ids)->latest('id')->get();

        \Breadcrumbs::push(trans('photos.index'), 'photos');
        \Breadcrumbs::push(trans('photos.cities'), 'photos/cities');
        \Breadcrumbs::push($city->title);

        $meta_title = $city->title;

        return view($this->view, compact('city', 'meta_title', 'photos'));
    }

    public function countries()
    {
        \Breadcrumbs::push(trans('photos.index'), 'photos');
        \Breadcrumbs::push(trans('photos.countries'));

        $countries = Country::with('cities')->orderBy(Country::titleField())->get();

        $trips_by_cities = [];

        Trip::published()
            ->get(['id', 'city_id', 'status'])
            ->each(function ($trip) use (&$trips_by_cities) {
                @$trips_by_cities[$trip->city_id] += 1;
            });

        $countries = $countries->each(function ($country) use (&$trips_by_cities) {
            $trips_count = 0;

            $country->cities->each(function ($city) use (&$trips_by_cities, &$trips_count) {
                $city->trips_count = $trips_by_cities[$city->id] ?? 0;

                $trips_count += $city->trips_count;
            });

            $country->trips_count = $trips_count;
        })->filter(function ($country) {
            return $country->trips_count;
        });

        return view($this->view, compact('countries'));
    }

    public function country($slug)
    {
        $country = Country::where('slug', $slug)->firstOrFail();

        $ids = Trip::idsByCountry($country->id);

        abort_if(empty($ids), 404);

        $photos = Photo::forTrips($ids)->latest('id')->get();

        \Breadcrumbs::push(trans('photos.index'), 'photos');
        \Breadcrumbs::push(trans('photos.countries'), 'photos/countries');
        \Breadcrumbs::push($country->title);

        $meta_title = $country->title;

        return view($this->view, compact('country', 'meta_title', 'photos'));
    }

    public function faq()
    {
        \Breadcrumbs::push(trans('photos.index'), 'photos');
        \Breadcrumbs::push(trans('photos.faq'));

        return view($this->view);
    }

    public function map()
    {
        if ($this->request->ajax()) {
            $trip_id = $this->request->input('trip_id');

            return $this->pointsForMap($trip_id);
        }

        \Breadcrumbs::push(trans('photos.index'), 'photos');
        \Breadcrumbs::push(trans('photos.map'));

        return view($this->view);
    }

    public function show($id)
    {
        $photo = Photo::with('rel', 'rel.city', 'rel.city.country', 'tags')->findOrFail($id);

        $tag_id = $this->request->input('tag_id');
        $city_id = $this->request->input('city_id');
        $country_id = $this->request->input('country_id');

        $next = Photo::where('id', '>', $photo->id);
        $prev = Photo::where('id', '<', $photo->id)->orderBy('id', 'desc');

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

        \Breadcrumbs::push(trans('photos.index'), 'photos');

        if ($tag_id) {
            $tag = Tag::findOrFail($tag_id);

            \Breadcrumbs::push(trans('photos.tags'), 'photos/tags');
            \Breadcrumbs::push($tag->breadcrumb(), "photos/tags/{$tag_id}");
        } elseif ($city_id) {
            \Breadcrumbs::push(trans('photos.cities'), 'photos/cities');
            \Breadcrumbs::push($photo->rel->city->breadcrumb(), "photos/cities/{$photo->rel->city->slug}");
        } elseif ($country_id) {
            \Breadcrumbs::push(trans('photos.countries'), 'photos/countries');
            \Breadcrumbs::push($photo->rel->city->country->breadcrumb(), "photos/countries/{$photo->rel->city->country->slug}");
        }

        \Breadcrumbs::push(trans('photos.show'));

        $meta_title = "{$photo->rel->title}, {$photo->rel->period} {$photo->rel->year}";

        return view($this->view, compact('city_id', 'country_id', 'meta_title', 'next', 'photo', 'prev', 'tag_id'));
    }

    public function tag(Tag $tag)
    {
        \Breadcrumbs::push(trans('photos.index'), 'photos');
        \Breadcrumbs::push(trans('photos.tags'), 'photos/tags');
        \Breadcrumbs::push($tag->breadcrumb());

        event(new \App\Events\Stats\TagViewed($tag->id));

        $meta_title = "#{$tag->title}";

        return view($this->view, compact('meta_title', 'tag'));
    }

    public function tags()
    {
        \Breadcrumbs::push(trans('photos.index'), 'photos');
        \Breadcrumbs::push(trans('photos.tags'));

        // Тэги с фотками
        $tags_ids = \DB::table('taggable')
            ->select('tag_id')
            ->where('rel_type', 'Photo')
            ->distinct()
            ->get()
            ->pluck('tag_id');

        $tags = Tag::withCount('photos')->whereIn('id', $tags_ids)->orderBy(Tag::titleField())->get();

        return view($this->view, compact('tags'));
    }

    protected function pointsForMap($trip_id)
    {
        // Кэширование отключено при фильтре по поездке
        $cache_entry = $trip_id ? "photos-points-trip" : 'photos-points';
        $minutes = $trip_id ? 0 : 30;

        return \Cache::remember($cache_entry, $minutes, function () use ($trip_id) {
            $photos = Photo::with('rel')
                ->forTrip($trip_id)
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
                        'balloonContent' => sprintf('<p><a href="%s#%s">%s, %s %s<br><img class="image-200" src="%s"></a></p>', $photo->rel->www(), $basename, $photo->rel->title, $photo->rel->period, $photo->rel->year, $photo->thumbnailUrl()),
                        'clusterCaption' => $basename,
                    ],
                ];
            }

            return $collection;
        });
    }
}
