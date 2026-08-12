<?php

namespace App\Domain\Life\Observer;

use App\Domain\Life\Models\Photo;
use App\Utilities\CacheHelper;
use Illuminate\Support\Str;

class PhotoObserver
{
    public function __construct(private CacheHelper $cache) {}

    public function deleted(Photo $photo): void
    {
        $photo->deleteFiles();

        $this->cache->forgetPhotoPoints();
    }

    public function saved(Photo $photo): void
    {
        if ($photo->wasRecentlyCreated || $photo->wasChanged(['point', 'status', 'rel_type', 'rel_id', 'slug'])) {
            $this->cache->forgetPhotoPoints();
        }
    }

    public function saving(Photo $photo): void
    {
        $this->maintainConsistency($photo);
    }

    private function maintainConsistency(Photo $photo): void
    {
        $photo->slug = Str::trim($photo->slug);
    }
}
