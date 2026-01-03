<?php

namespace App\Domain\Exif;

use App\Domain\Spatial\Point;

class GetPointFromGpsDataAction
{
    public function execute(array $exifData): Point|null
    {
        if (!isset($exifData['GPSLatitude'], $exifData['GPSLongitude'], $exifData['GPSLatitudeRef'], $exifData['GPSLongitudeRef']) ||
            !in_array($exifData['GPSLatitudeRef'], ['N', 'E', 'S', 'W']) ||
            !in_array($exifData['GPSLongitudeRef'], ['N', 'E', 'S', 'W'])
        ) {
            return null;
        }

        $lat = $this->convertDegreesToFloat($exifData['GPSLatitude']);
        $lon = $this->convertDegreesToFloat($exifData['GPSLongitude']);

        if ($exifData['GPSLatitudeRef'] == 'S') {
            $lat *= -1;
        }

        if ($exifData['GPSLongitudeRef'] == 'W') {
            $lon *= -1;
        }

        $locale = localeconv();

        // Обработка разделителей с учетом текущей локали
        $lat = str_replace($locale['decimal_point'], '.', round($lat, 6));
        $lon = str_replace($locale['decimal_point'], '.', round($lon, 6));

        return new Point($lat, $lon);
    }

    private function convertDegreesToFloat(array $coordinates): float
    {
        $degreesAry = explode('/', $coordinates[0]);
        $minutesAry = explode('/', $coordinates[1]);
        $secondsAry = explode('/', $coordinates[2]);

        $degrees = $degreesAry[0] / $degreesAry[1];
        $minutes = $minutesAry[0] / $minutesAry[1];
        $seconds = $secondsAry[0] / $secondsAry[1];

        return $degrees + ($minutes * 60 + $seconds) / 3600;
    }
}
