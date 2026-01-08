<?php

namespace App\Http\Controllers\Acp\Dev;

use App\Domain\ImageConverter\ImageConverter;
use App\Domain\SessionKey;

class ThumbnailsController
{
    public function index()
    {
        return view('acp.dev.thumbnails.index');
    }

    public function clean()
    {
        $storage = \Storage::disk('temp');

        $files = collect($storage->allFiles())
            ->filter(fn ($file) => $file !== '.gitignore')
            ->all();

        $storage->delete($files);

        return redirect(path([ThumbnailsController::class, 'index']))
            ->with(SessionKey::FlashMessage->value, 'Папка очищена');
    }

    public function store()
    {
        $file = request()->file('file');

        if ($file === null || !$file->isValid()) {
            throw new \Exception('Необходимо предоставить хотя бы один файл');
        }

        $image = (new ImageConverter)
            ->autoOrient()
            ->resize(2000, 2000)
            ->quality(75)
            ->convert($file->getRealPath());

        $pathinfo = pathinfo($file->getClientOriginalName());
        $filename = $pathinfo['filename'] . '.' . str_replace('jpeg', 'jpg', strtolower($pathinfo['extension']));

        rename($image->getRealPath(), public_path("uploads/temp/{$filename}"));

        return ['filename' => $filename];
    }
}
