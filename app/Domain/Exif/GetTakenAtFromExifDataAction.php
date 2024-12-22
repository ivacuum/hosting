<?php

namespace App\Domain\Exif;

use Carbon\CarbonImmutable;
use Carbon\Exceptions\InvalidFormatException;

class GetTakenAtFromExifDataAction
{
    public function execute(array $exifData): CarbonImmutable|null
    {
        if (!isset($exifData['DateTime'])) {
            return null;
        }

        try {
            return CarbonImmutable::createFromFormat('Y:m:d H:i:s', $exifData['DateTime']);
        } catch (InvalidFormatException) {
            return CarbonImmutable::parse($exifData['DateTime']);
        }
    }
}
