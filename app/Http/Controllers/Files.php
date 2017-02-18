<?php namespace App\Http\Controllers;

use App\Events\Stats\FileDownloadClicked;
use App\File;

class Files extends Controller
{
    public function download(File $file)
    {
        $file->timestamps = false;
        $file->increment('downloads');

        event(new FileDownloadClicked());

        return redirect($file->downloadPath())
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', "attachment; {$file->headerBasename()}")
            ->header('Content-Length', $file->size);
    }
}
