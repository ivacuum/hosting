<?php namespace App\Http\Controllers;

use App\Photo;
use App\Tag;

class Photos extends Controller
{
    public function index()
    {
        \Breadcrumbs::push(trans('photos.index'));

        $photos = Photo::latest('id')->take(50)->get();

        return view($this->view, compact('photos'));
    }

    public function map()
    {
        \Breadcrumbs::push(trans('photos.index'), 'photos');

        return view($this->view);
    }

    public function show(Photo $photo)
    {
        \Breadcrumbs::push(trans('photos.index'), 'photos');
        \Breadcrumbs::push(trans('photos.show'));

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

        return view($this->view, compact('next', 'photo', 'prev', 'tag_id'));
    }

    public function tag(Tag $tag)
    {
        \Breadcrumbs::push(trans('photos.index'), 'photos');

        event(new \App\Events\Stats\TagViewed($tag->id));

        return view($this->view, compact('tag'));
    }

    public function tags()
    {
        \Breadcrumbs::push(trans('photos.index'), 'photos');

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
