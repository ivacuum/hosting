<?php namespace App\Http\Controllers;

use App\Http\Requests\GalleryStoreForm;
use App\Image;

class Gallery extends Controller
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

    public function store(GalleryStoreForm $request)
    {
        $file = $request->image();

        $image = Image::newFromFile($file, $request->user()->id);
        $image->siteThumbnail($file);
        $image->upload($file);
        $image->save();

        event(new \App\Events\Stats\GalleryImageUploaded);

        return [
            'id' => $image->id,
            'status' => 'OK',
            'original' => $image->originalUrl(),
            'thumbnail' => $image->thumbnailUrl(),
        ];
    }

    public function view(Image $image)
    {
        event(new \App\Events\Stats\GalleryImageViewed($image->id));

        return view('gallery.view', ['image' => $image]);
    }
}
