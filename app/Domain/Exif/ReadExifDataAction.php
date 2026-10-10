<?php

namespace App\Domain\Exif;

class ReadExifDataAction
{
    public function __construct(private ReadRawExifDataAction $readRawExifData) {}

    public function execute(string $filePath): array
    {
        $data = $this->readRawExifData->execute($filePath);

        foreach ($data as $key => $value) {
            if (!mb_check_encoding($key, 'UTF-8') || !mb_check_encoding($value, 'UTF-8')) {
                unset($data[$key]);
            }
        }

        return $data;
    }
}
