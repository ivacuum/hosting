<?php namespace App\Http\Controllers;

use App\File;

class Files extends Controller
{
    public function index()
    {
        \Breadcrumbs::push(trans('menu.files'));

        $models = File::published()
            ->orderBy('id', 'desc')
            ->paginate()
            ->withPath(path("{$this->class}@index"));

        return view($this->view, compact('models'));
    }

    public function download(int $id)
    {
        /* @var File $file */
        $file = File::findOrFail($id);

        abort_unless($file->status === File::STATUS_PUBLISHED, 404);

        $file->timestamps = false;
        $file->increment('downloads');

        event(new \App\Events\Stats\FileDownloadClicked);

        return redirect($file->downloadPath())
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', "attachment; {$file->headerBasename()}")
            ->header('Content-Length', $file->size);
    }
}
