<?php

namespace App\Observers;

use App\Image;

class ImageObserver
{
    public function deleted(Image $image)
    {
        $image->deleteFiles();
    }
}
