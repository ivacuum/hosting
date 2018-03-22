<?php namespace App;

use Illuminate\Http\UploadedFile;
use Ivacuum\Generic\Services\ImageConverter;

class Avatar
{
    const WIDTH = 200;
    const HEIGHT = 200;
    const FILTER = 'triangle';
    const QUALITY = 75;

    protected $file;
    protected $extension;

    public function delete($filename)
    {
        return \Storage::disk('avatars')->delete($filename);
    }

    public function originalUrl($filename): string
    {
        return \App::environment() === 'production'
            ? "https://ivacuum.org/avatars/{$filename}"
            : "/uploads/avatars/{$filename}";
    }

    public function resize(UploadedFile $file)
    {
        return (new ImageConverter)
            ->crop(static::WIDTH, static::HEIGHT)
            ->filter(static::FILTER)
            ->quality(static::QUALITY)
            ->convert($file->getRealPath());
    }

    public function upload(UploadedFile $file, $user_id)
    {
        $filename = sprintf('%s_%s.%s', $user_id, str_random(6), strtolower($file->getClientOriginalExtension()));

        \Storage::disk('avatars')->putFileAs('', $this->resize($file), $filename);

        return $filename;
    }
}
