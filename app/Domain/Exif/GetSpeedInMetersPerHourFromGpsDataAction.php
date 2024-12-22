<?php

namespace App\Domain\Exif;

class GetSpeedInMetersPerHourFromGpsDataAction
{
    public function __construct(private DivideExifValueAction $divideExifValue) {}

    public function execute(array $exifData): int|null
    {
        if (!isset($exifData['GPSSpeed'], $exifData['GPSSpeedRef'])) {
            return null;
        }

        if ($exifData['GPSSpeedRef'] !== 'K') {
            return null;
        }

        return $this->divideExifValue->execute($exifData['GPSSpeed'], precision: 3) * 1000;
    }
}
