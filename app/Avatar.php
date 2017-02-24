<?php namespace App;

use App\Services\ImageConverter;
use Illuminate\Http\UploadedFile;

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

    public function originalUrl($filename)
    {
        return \App::environment('production')
            ? "https://img.ivacuum.ru/avatars/{$filename}"
            : "/uploads/avatars/{$filename}";
    }

    public function resize(UploadedFile $file)
    {
        return (new ImageConverter())
            ->crop(self::WIDTH, self::HEIGHT)
            ->filter(self::FILTER)
            ->quality(self::QUALITY)
            ->convert($file->getRealPath());
    }

    public function upload(UploadedFile $file, $user_id)
    {
        $filename = sprintf('%s_%s.%s', $user_id, str_random(6), strtolower($file->getClientOriginalExtension()));

        \Storage::disk('avatars')->putFileAs('', $this->resize($file), $filename);

        return $filename;
    }
}
