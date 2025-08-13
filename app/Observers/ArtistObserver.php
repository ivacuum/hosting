<?php

namespace App\Observers;

use App\Artist;
use App\Utilities\CacheHelper;
use Illuminate\Support\Str;

class ArtistObserver
{
    public function __construct(private CacheHelper $cache) {}

    public function deleted()
    {
        $this->cache->forgetGigs();
    }

    public function saving(Artist $artist)
    {
        $this->maintainConsistency($artist);
    }

    public function saved()
    {
        $this->cache->forgetGigs();
    }

    private function maintainConsistency(Artist $artist): void
    {
        $artist->slug = Str::trim($artist->slug);
        $artist->title = Str::trim($artist->title);
    }
}
