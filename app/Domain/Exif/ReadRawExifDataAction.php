<?php

namespace App\Domain\Exif;

class ReadRawExifDataAction
{
    public function execute(string $filePath): array
    {
        $data = exif_read_data($filePath);

        if ($data === false) {
            return [];
        }

        return $data;
    }
}
