<?php namespace App\Http\Controllers;

use App\Image;

class Gallery
{
    public function index()
    {
        $images = Image::query()
            ->whereBelongsTo(request()->user())
            ->orderByDesc('id')
            ->paginate(25);

        return view('gallery.index', ['images' => $images]);
    }

    public function preview(Image $image)
    {
        event(new \App\Events\Stats\GalleryImagePreviewed($image->id));

        return view('gallery.preview', ['image' => $image]);
    }

    public function show(Image $image)
    {
        return view('gallery.view', ['image' => $image]);
    }
}
