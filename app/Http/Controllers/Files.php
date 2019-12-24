<?php namespace App\Http\Controllers;

use App\File;

class Files extends Controller
{
    public function index()
    {
        \Breadcrumbs::push(trans('menu.files'));

        $models = File::published()
            ->orderByDesc('id')
            ->paginate()
            ->withPath(path([self::class, 'index']));

        return view($this->view, ['models' => $models]);
    }

    public function download(File $file)
    {
        abort_unless($file->isPublished(), 404);

        $file->incrementDownloads();

        return redirect($file->downloadPath())
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', "attachment; {$file->headerBasename()}")
            ->header('Content-Length', $file->size);
    }
}
