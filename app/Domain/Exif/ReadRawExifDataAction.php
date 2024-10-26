<?php

namespace App\Domain\Exif;

class ReadRawExifDataAction
{
    public function execute(string $filePath): array
    {
        try {
            $data = exif_read_data($filePath);
        } catch (\ErrorException $e) {
            if (str_contains($e->getMessage(), 'File not supported')) {
                return [];
            }

            throw $e;
        }

        if ($data === false) {
            return [];
        }

        return $data;
    }
}
