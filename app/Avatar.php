<?php namespace App;

use Illuminate\Http\UploadedFile;
use Ivacuum\Generic\Services\ImageConverter;

class Avatar
{
    private const WIDTH = 200;
    private const HEIGHT = 200;
    private const FILTER = 'triangle';
    private const QUALITY = 75;

    public function delete($filename): bool
    {
        return \Storage::disk('avatars')->delete($filename);
    }

    public function resize(UploadedFile $file): UploadedFile
    {
        return (new ImageConverter)
            ->crop(static::WIDTH, static::HEIGHT)
            ->filter(static::FILTER)
            ->quality(static::QUALITY)
            ->convert($file->getRealPath());
    }

    public function upload(UploadedFile $file, $userId): string
    {
        $filename = sprintf('%s_%s.%s', $userId, \Str::random(6), strtolower($file->getClientOriginalExtension()));

        \Storage::disk('avatars')->putFileAs('', $this->resize($file), $filename);

        return $filename;
    }

    public function url($filename): string
    {
        return \Storage::disk('avatars')->url($filename);
    }
}
