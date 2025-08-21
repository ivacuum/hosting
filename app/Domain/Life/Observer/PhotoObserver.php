<?php

namespace App\Domain\Life\Observer;

use App\Domain\Life\Models\Photo;
use Illuminate\Support\Str;

class PhotoObserver
{
    public function deleted(Photo $photo)
    {
        $photo->deleteFiles();
    }

    public function saving(Photo $photo)
    {
        $this->maintainConsistency($photo);
    }

    private function maintainConsistency(Photo $photo): void
    {
        $photo->slug = Str::trim($photo->slug);
    }
}
