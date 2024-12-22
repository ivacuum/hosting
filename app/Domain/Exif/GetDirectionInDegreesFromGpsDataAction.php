<?php

namespace App\Domain\Exif;

class GetDirectionInDegreesFromGpsDataAction
{
    public function __construct(private DivideExifValueAction $divideExifValue) {}

    public function execute(array $exifData): int|null
    {
        if (!isset($exifData['GPSImgDirection'], $exifData['GPSImgDirectionRef'])) {
            return null;
        }

        // T — true direction
        // M — magnetic direction
        if ($exifData['GPSImgDirectionRef'] !== 'T') {
            return null;
        }

        return $this->divideExifValue->execute($exifData['GPSImgDirection']);
    }
}
