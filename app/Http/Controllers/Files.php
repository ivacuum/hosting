<?php namespace App\Http\Controllers;

use App\File;

class Files extends Controller
{
    public function download(File $file)
    {
        $file->timestamps = false;
        $file->increment('downloads');

        event(new \App\Events\Stats\FileDownloadClicked);

        return redirect($file->downloadPath())
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', "attachment; {$file->headerBasename()}")
            ->header('Content-Length', $file->size);
    }
}
