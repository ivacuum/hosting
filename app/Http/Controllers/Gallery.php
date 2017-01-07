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
        dd('Actual upload');
    }
}
