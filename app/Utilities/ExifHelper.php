<?php

namespace App\Utilities;

class ExifHelper
{
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
     * @return array|bool
     */
    public static function latLon($exif): array
    {
        if (!isset($exif['GPSLatitude']) ||
            !isset($exif['GPSLongitude']) ||
            !isset($exif['GPSLatitudeRef']) ||
            !isset($exif['GPSLongitudeRef']) ||
            !in_array($exif['GPSLatitudeRef'], ['N', 'E', 'S', 'W']) ||
            !in_array($exif['GPSLongitudeRef'], ['N', 'E', 'S', 'W'])
        ) {
            return ['lat' => null, 'lon' => null];
        }

        $latRef = $exif['GPSLatitudeRef'];
        $lonRef = $exif['GPSLongitudeRef'];

        $latDegreesAry = explode('/', $exif['GPSLatitude'][0]);
        $latMinutesAry = explode('/', $exif['GPSLatitude'][1]);
        $latSecondsAry = explode('/', $exif['GPSLatitude'][2]);
        $lonDegreesAry = explode('/', $exif['GPSLongitude'][0]);
        $lonMinutesAry = explode('/', $exif['GPSLongitude'][1]);
        $lonSecondsAry = explode('/', $exif['GPSLongitude'][2]);

        $latDegrees = $latDegreesAry[0] / $latDegreesAry[1];
        $latMinutes = $latMinutesAry[0] / $latMinutesAry[1];
        $latSeconds = $latSecondsAry[0] / $latSecondsAry[1];
        $lonDegrees = $lonDegreesAry[0] / $lonDegreesAry[1];
        $lonMinutes = $lonMinutesAry[0] / $lonMinutesAry[1];
        $lonSeconds = $lonSecondsAry[0] / $lonSecondsAry[1];

        $lat = (float) $latDegrees + ($latMinutes * 60 + $latSeconds) / 3600;
        $lon = (float) $lonDegrees + ($lonMinutes * 60 + $lonSeconds) / 3600;

        $latRef == 'S' ? $lat *= -1 : false;
        $lonRef == 'W' ? $lon *= -1 : false;

        $locale = localeconv();

        /* Обработка разделителей с учетом текущей локали */
        $lat = str_replace($locale['decimal_point'], '.', round($lat, 6));
        $lon = str_replace($locale['decimal_point'], '.', round($lon, 6));

        return [
            'lat' => $lat,
            'lon' => $lon,
        ];
    }
}
