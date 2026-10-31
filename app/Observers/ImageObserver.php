<?php

namespace App\Observers;

use App\Models\Image;

class ImageObserver
{
    public function deleted(Image $image): void
    {
        $image->deleteFiles();
    }
}
