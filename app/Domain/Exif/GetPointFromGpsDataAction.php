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

        if ($lat === null || $lon === null || abs($lat) > 90 || abs($lon) > 180) {
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

        $degrees = $this->rationalToFloat($coordinates[0]);
        $minutes = $this->rationalToFloat($coordinates[1]);
        $seconds = $this->rationalToFloat($coordinates[2]);

        if ($degrees === null || $minutes === null || $seconds === null) {
            return null;
        }

        return $degrees + ($minutes * 60 + $seconds) / 3600;
    }

    private function rationalToFloat(mixed $value): float|null
    {
        $parts = is_string($value) ? explode('/', $value) : [];

        if (count($parts) !== 2 || !is_numeric($parts[0]) || !is_numeric($parts[1]) || (float) $parts[1] === 0.0) {
            return null;
        }

        return $parts[0] / $parts[1];
    }
}
