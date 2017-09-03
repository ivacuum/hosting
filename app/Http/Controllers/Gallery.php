<?php namespace App\Http\Controllers;

use App\Image;

class Gallery extends Controller
{
    public function index()
    {
        $images = Image::where('user_id', request()->user()->id)
            ->orderBy('id', 'desc')
            ->paginate(25);

        return view($this->view, compact('images'));
    }

    public function preview(Image $image)
    {
        event(new \App\Events\Stats\GalleryImagePreviewed($image->id));

        return view($this->view, compact('image'));
    }

    public function view(Image $image)
    {
        event(new \App\Events\Stats\GalleryImageViewed($image->id));

        return view($this->view, compact('image'));
    }

    public function upload()
    {
        return view($this->view);
    }

    public function uploadPost()
    {
        if (!request()->ajax()) {
            return ['status' => 'error'];
        }

        request()->validate([
            'file' => 'required|mimetypes:image/gif,image/jpeg,image/png|max:6144',
        ]);

        $file = request()->file('file');

        if (is_null($file) || !$file->isValid()) {
            throw new \Exception('Необходимо предоставить хотя бы один файл');
        }

        $image = Image::createFromFile($file, request()->user()->id);
        $image->siteThumbnail($file);
        $image->upload($file);
        $image->save();

        event(new \App\Events\Stats\GalleryImageUploaded);

        return [
            'status' => 'OK',
            'original' => $image->originalUrl(),
            'thumbnail' => $image->thumbnailUrl(),
        ];
    }

    protected function appendBreadcrumbs()
    {
        $this->middleware('breadcrumbs:gallery.index,gallery');
        $this->middleware('breadcrumbs:gallery.preview')->only('preview');
        $this->middleware('breadcrumbs:gallery.view')->only('view');
        $this->middleware('breadcrumbs:gallery.upload')->only('upload');
    }
}
