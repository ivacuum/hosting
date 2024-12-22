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
        };

        return $this->divideExifValue->execute($exifData['GPSAltitude'], precision: 2) * 100 * $sign;
    }
}
