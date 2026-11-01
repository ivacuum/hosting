<?php

namespace App\Domain\Exif;

class GetAltitudeInCentimetersFromGpsDataAction
{
    public function __construct(private DivideExifValueAction $divideExifValue) {}

    public function execute(array $exifData): int|null
    {
        if (!isset($exifData['GPSAltitude'], $exifData['GPSAltitudeRef'])) {
            return null;
        }

        $sign = match ($exifData['GPSAltitudeRef']) {
            chr(0), 0 => 1,
            chr(1), 1 => -1,
            default => null,
        };

        $altitude = $this->divideExifValue->execute($exifData['GPSAltitude'], precision: 2);

        if ($sign === null || $altitude === null) {
            return null;
        }

        return (int) round($altitude * 100 * $sign);
    }
}
