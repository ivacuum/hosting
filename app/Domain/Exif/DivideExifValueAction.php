<?php

namespace App\Domain\Exif;

class DivideExifValueAction
{
    public function execute(string $value, int $precision = 2): float|int|null
    {
        $parts = explode('/', $value);

        if (count($parts) !== 2 || !is_numeric($parts[0]) || !is_numeric($parts[1]) || (float) $parts[1] === 0.0) {
            return null;
        }

        if ((float) $parts[0] === 0.0) {
            return 0;
        }

        return round($parts[0] / $parts[1], $precision);
    }
}
