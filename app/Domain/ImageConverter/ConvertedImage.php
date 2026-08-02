<?php

namespace App\Domain\ImageConverter;

use Illuminate\Http\UploadedFile;

class ConvertedImage extends UploadedFile
{
    public function __destruct()
    {
        $path = $this->getPathname();

        if (is_file($path)) {
            unlink($path);
        }
    }
}
