<?php namespace App\Http\Controllers;

use App\Photo;
use App\Tag;

class Photos extends Controller
{
    public function index()
    {
        \Breadcrumbs::push(trans('photos.index'));

        $photos = Photo::latest('id')->paginate(20);

        return view($this->view, compact('photos'));
    }

    public function map()
    {
        \Breadcrumbs::push(trans('photos.index'), 'photos');
        \Breadcrumbs::push(trans('photos.map'));

        $photos = Photo::with('rel')->where('lat', '<>', '')->where('lon', '<>', '')->oldest('id')->get();

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

        return view($this->view, compact('collection'));
    }

    public function show(Photo $photo)
    {
        $tag_id = $this->request->input('tag_id');

        $next = Photo::where('id', '>', $photo->id);
        $prev = Photo::where('id', '<', $photo->id)->orderBy('id', 'desc');

        // Просмотр в пределах одного тэга
        if ($tag_id) {
            $next = $next->whereHas('tags', function ($query) use ($tag_id) {
                $query->where('tag_id', $tag_id);
            });

            $prev = $prev->whereHas('tags', function ($query) use ($tag_id) {
                $query->where('tag_id', $tag_id);
            });
        }

        $next = $next->first();
        $prev = $prev->first();

        event(new \App\Events\Stats\PhotoViewed($photo->id));

        \Breadcrumbs::push(trans('photos.index'), 'photos');

        if ($tag_id) {
            $tag = Tag::findOrFail($tag_id);

            \Breadcrumbs::push(trans('photos.tags'), 'photos/tags');
            \Breadcrumbs::push($tag->breadcrumb(), "photos/tags/{$tag_id}");
        }

        \Breadcrumbs::push(trans('photos.show'));

        return view($this->view, compact('next', 'photo', 'prev', 'tag_id'));
    }

    public function tag(Tag $tag)
    {
        \Breadcrumbs::push(trans('photos.index'), 'photos');
        \Breadcrumbs::push(trans('photos.tags'), 'photos/tags');
        \Breadcrumbs::push($tag->breadcrumb());

        event(new \App\Events\Stats\TagViewed($tag->id));

        return view($this->view, compact('tag'));
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

        $tags = Tag::whereIn('id', $tags_ids)->orderBy(Tag::titleField())->get();

        return view($this->view, compact('tags'));
    }
}
