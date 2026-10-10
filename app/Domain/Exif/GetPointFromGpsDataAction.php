<?php

namespace App\Domain\Exif;

use App\Domain\Spatial\Point;

class GetPointFromGpsDataAction
{
    public function execute(array $exifData): Point|null
    {
        if (!isset($exifData['GPSLatitude'], $exifData['GPSLongitude'], $exifData['GPSLatitudeRef'], $exifData['GPSLongitudeRef']) ||
            !in_array($exifData['GPSLatitudeRef'], ['N', 'S'], true) ||
            !in_array($exifData['GPSLongitudeRef'], ['E', 'W'], true)
        ) {
            return null;
        }

        $lat = $this->convertDegreesToFloat($exifData['GPSLatitude']);
        $lon = $this->convertDegreesToFloat($exifData['GPSLongitude']);

        if ($lat === null || $lon === null) {
            return null;
        }

        if ($exifData['GPSLatitudeRef'] == 'S') {
            $lat *= -1;
        }

        if ($exifData['GPSLongitudeRef'] == 'W') {
            $lon *= -1;
        }

        return new Point((string) round($lat, 6), (string) round($lon, 6));
    }

    private function convertDegreesToFloat(array $coordinates): float|null
    {
        if (!isset($coordinates[0], $coordinates[1], $coordinates[2])) {
            return null;
        }

        $degreesAry = explode('/', $coordinates[0]);
        $minutesAry = explode('/', $coordinates[1]);
        $secondsAry = explode('/', $coordinates[2]);

        if ($degreesAry[1] == 0 || $minutesAry[1] == 0 || $secondsAry[1] == 0) {
            return null;
        }

        $degrees = $degreesAry[0] / $degreesAry[1];
        $minutes = $minutesAry[0] / $minutesAry[1];
        $seconds = $secondsAry[0] / $secondsAry[1];

        return $degrees + ($minutes * 60 + $seconds) / 3600;
    }
}
