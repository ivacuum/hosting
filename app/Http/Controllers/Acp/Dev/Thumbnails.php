<?php namespace App\Http\Controllers\Acp\Dev;

use App\Http\Controllers\Acp\Controller;
use App\Services\ImageConverter;

class Thumbnails extends Controller
{
    public function index()
    {
        return view($this->view);
    }

    public function clean()
    {
        foreach (glob(public_path('uploads/temp/*')) as $filename) {
            unlink($filename);
        }

        return redirect()->action("{$this->class}@index")
            ->with('message', 'Папка очищена');
    }

    public function thumbnailsPost()
    {
        $file = $this->request->file('file');

        if (is_null($file) || !$file->isValid()) {
            throw new \Exception('Необходимо предоставить хотя бы один файл');
        }

        $image = (new ImageConverter())
            ->resize(2000, 1500)
            ->quality(75)
            ->convert($file->getRealPath());

        rename($image->getRealPath(), public_path('uploads/temp/'.$file->getClientOriginalName()));

        return ['filename' => $file->getClientOriginalName()];
    }

    /**
     * [GPSLatitudeRef] => N
     * [GPSLatitude] => Array
     *     (
     *         [0] => 53/1
     *         [1] => 1/1
     *         [2] => 4622/100
     *     )
     *
     * [GPSLongitudeRef] => E
     * [GPSLongitude] => Array
     *     (
     *         [0] => 129/1
     *         [1] => 43/1
     *         [2] => 1244/100
     *     )
     *
     * @param  array  $exif
     * @return array|boolean
     */
    protected function processGps($exif)
    {
        if (!isset($exif['GPSLatitude']) ||
            !isset($exif['GPSLongitude']) ||
            !isset($exif['GPSLatitudeRef']) ||
            !isset($exif['GPSLongitudeRef']) ||
            !in_array($exif['GPSLatitudeRef'], ['N', 'E', 'S', 'W']) ||
            !in_array($exif['GPSLongitudeRef'], ['N', 'E', 'S', 'W'])
        ) {
            return false;
        }

        $lat_ref = $exif['GPSLatitudeRef'];
        $lon_ref = $exif['GPSLongitudeRef'];

        $lat_degrees_ary = explode('/', $exif['GPSLatitude'][0]);
        $lat_minutes_ary = explode('/', $exif['GPSLatitude'][1]);
        $lat_seconds_ary = explode('/', $exif['GPSLatitude'][2]);
        $lon_degrees_ary = explode('/', $exif['GPSLongitude'][0]);
        $lon_minutes_ary = explode('/', $exif['GPSLongitude'][1]);
        $lon_seconds_ary = explode('/', $exif['GPSLongitude'][2]);

        $lat_degrees = $lat_degrees_ary[0] / $lat_degrees_ary[1];
        $lat_minutes = $lat_minutes_ary[0] / $lat_minutes_ary[1];
        $lat_seconds = $lat_seconds_ary[0] / $lat_seconds_ary[1];
        $lon_degrees = $lon_degrees_ary[0] / $lon_degrees_ary[1];
        $lon_minutes = $lon_minutes_ary[0] / $lon_minutes_ary[1];
        $lon_seconds = $lon_seconds_ary[0] / $lon_seconds_ary[1];

        $lat = (float) $lat_degrees + ($lat_minutes * 60 + $lat_seconds) / 3600;
        $lon = (float) $lon_degrees + ($lon_minutes * 60 + $lon_seconds) / 3600;

        $lat_ref == 'S' ? $lat *= -1 : false;
        $lon_ref == 'W' ? $lon *= -1 : false;

        $locale = localeconv();

        /* Обработка разделителей с учетом текущей локали */
        $lat = str_replace($locale['decimal_point'], '.', $lat);
        $lon = str_replace($locale['decimal_point'], '.', $lon);

        return compact('lat', 'lon');
    }
}
