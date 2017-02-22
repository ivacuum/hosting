<?php namespace App\Http\Controllers;

use App\Image;

class Gallery extends Controller
{
    public function index()
    {
        \Breadcrumbs::push(trans('gallery.index'));

        $images = Image::where('user_id', $this->request->user()->id)
            ->orderBy('id', 'desc')
            ->paginate(25);

        return view($this->view, compact('images'));
    }

    public function preview(Image $image)
    {
        \Breadcrumbs::push(trans('gallery.index'), 'gallery');
        \Breadcrumbs::push(trans('gallery.preview'));

        return view($this->view, compact('image'));
    }

    public function view(Image $image)
    {
        \Breadcrumbs::push(trans('gallery.index'), 'gallery');
        \Breadcrumbs::push(trans('gallery.view'));

        return view($this->view, compact('image'));
    }

    public function upload()
    {
        \Breadcrumbs::push(trans('gallery.index'), 'gallery');
        \Breadcrumbs::push(trans('gallery.upload'));

        return view($this->view);
    }

    public function uploadPost()
    {
        if (!$this->request->ajax()) {
            return ['status' => 'error'];
        }

        $this->validate($this->request, [
            'file' => 'required|mimetypes:image/gif,image/jpeg,image/png|max:6144',
        ]);

        $file = $this->request->file('file');

        if (is_null($file) || !$file->isValid()) {
            throw new \Exception('Необходимо предоставить хотя бы один файл');
        }

        $image = Image::createFromFile($file, $this->request->user()->id);
        $image->siteThumbnail($file);
        $image->upload($file);
        $image->save();

        return [
            'status' => 'OK',
            'original' => $image->originalUrl(),
            'thumbnail' => $image->thumbnailUrl(),
        ];
    }
}
