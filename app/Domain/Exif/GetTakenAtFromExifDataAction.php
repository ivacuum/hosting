<?php

namespace App\Domain\Exif;

use Carbon\CarbonImmutable;
use Carbon\Exceptions\InvalidFormatException;

class GetTakenAtFromExifDataAction
{
    public function execute(array $exifData): CarbonImmutable|null
    {
        $dateTime = $exifData['DateTimeOriginal'] ?? $exifData['DateTime'] ?? null;

        if ($dateTime === null) {
            return null;
        }

        try {
            return CarbonImmutable::createFromFormat('Y:m:d H:i:s', $dateTime);
        } catch (InvalidFormatException) {
            return CarbonImmutable::parse($dateTime);
        }
    }
}
