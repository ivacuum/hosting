<?php

namespace App\Domain\Avatar;

use App\Domain\ImageConverter\ImageConverter;
use Illuminate\Http\UploadedFile;

class Avatar
{
    private const int WIDTH = 200;
    private const int HEIGHT = 200;
    private const string FILTER = 'triangle';
    private const int QUALITY = 75;

    public function __construct(private ImageConverter $imageConverter) {}

    public function delete($filename): bool
    {
        return \Storage::disk('avatars')->delete($filename);
    }

    public function resize(UploadedFile $file): UploadedFile
    {
        return $this->imageConverter
            ->crop(self::WIDTH, self::HEIGHT)
            ->filter(self::FILTER)
            ->quality(self::QUALITY)
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
