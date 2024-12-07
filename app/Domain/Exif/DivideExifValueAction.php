<?php

namespace App\Domain\Exif;

class DivideExifValueAction
{
    public function execute(string $value, int $precision = 2): float|int
    {
        $parts = explode('/', $value);

        if ($parts[0] === '0') {
            return 0;
        }

        return round($parts[0] / $parts[1], $precision);
    }
}
