<?php

namespace App\Http\Controllers;

use App\File;
use App\Scope\FilePublishedScope;

class FileController
{
    public function index()
    {
        $models = File::query()
            ->tap(new FilePublishedScope)
            ->orderByDesc('id')
            ->paginate(40);

        return view('files.index', ['models' => $models]);
    }

    public function download(File $file)
    {
        abort_unless($file->status->isPublished(), 404);

        $file->incrementDownloads();

        return redirect($file->downloadPath())
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', "attachment; {$file->headerBasename()}")
            ->header('Content-Length', $file->size);
    }
}
