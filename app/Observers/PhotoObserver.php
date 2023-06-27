<?php

namespace App\Observers;

use App\Photo;

class PhotoObserver
{
    public function deleted(Photo $photo)
    {
        $photo->deleteFiles();
    }
}
