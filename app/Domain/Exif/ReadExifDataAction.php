<?php

namespace App\Domain\Exif;

class ReadExifDataAction
{
    public function __construct(private ReadRawExifDataAction $readRawExifData) {}

    public function execute(string $filePath): array
    {
        $data = $this->readRawExifData->execute($filePath);

        foreach ($data as $key => $value) {
            // Непечатные данные не сможем передать в JS
            if (!mb_check_encoding($value, 'UTF-8')) {
                unset($data[$key]);
            }

            if (!mb_check_encoding($key, 'UTF-8')) {
                unset($data[$key]);
            }

            // Что-то непечатное встречалось
            // if (str_starts_with($key, 'UndefinedTag:')) {
            //     unset($data[$key]);
            // }
        }

        return $data;
    }
}
