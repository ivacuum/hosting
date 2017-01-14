<?php namespace App\Http\Controllers\Acp\Dev;

use App\Http\Controllers\Acp\Controller;

class Thumbnails extends Controller
{
    public function index()
    {
        return view($this->view);
    }

    public function thumbnailsPost()
    {
        $files = $this->request->file('files', []);

        if (empty($files)) {
            throw new \Exception('Необходимо предоставить хотя бы один файл');
        }

        $sizes = [['width' => 2000, 'height' => 1500]];

        $thumbnails = [];

        /* @var $file \Symfony\Component\HttpFoundation\File\UploadedFile */
        foreach ($files as $file) {
            if (is_null($file) || !$file->isValid()) {
                continue;
            }

            foreach ($sizes as $size) {
                $source = $file->getRealPath();
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();

                $dir = "uploads/temp";

                @mkdir($dir);

                $dest = "{$dir}/{$filename}.{$extension}";

                // $exif = @exif_read_data($source, 'GPS');

                $coordinates = false; // $this->processGps($exif);
                $lat = $lon = false;

                if (false !== $coordinates) {
                    $lat = $coordinates['lat'];
                    $lon = $coordinates['lon'];
                }

                passthru(sprintf(
                    '%s gm convert -size %dx%d "%s" %s -resize %dx%d\> +profile "*" "%s"',
                    escapeshellcmd('/usr/bin/env'),
                    $size['width'],
                    $size['height'],
                    $source,
                    $extension === 'jpg' ? '-quality 75' : '',
                    $size['width'],
                    $size['height'],
                    $dest
                ));

                $thumbnails[] = [
                    'dest' => $dest,
                    'lat'  => $lat,
                    'lon'  => $lon,
                ];
            }
        }

        if ($this->request->ajax()) {
            return compact('thumbnails');
        }

        return view($this->view, compact('thumbnails'));
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
