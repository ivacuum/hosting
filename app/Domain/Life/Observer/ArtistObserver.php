<?php

namespace App\Domain\Life\Observer;

use App\Domain\Life\Models\Artist;
use App\Utilities\CacheHelper;
use Illuminate\Support\Str;

class ArtistObserver
{
    public function __construct(private CacheHelper $cache) {}

    public function deleted(): void
    {
        $this->cache->forgetGigs();
    }

    public function saving(Artist $artist): void
    {
        $this->maintainConsistency($artist);
    }

    public function saved(): void
    {
        $this->cache->forgetGigs();
    }

    private function maintainConsistency(Artist $artist): void
    {
        $artist->slug = Str::trim($artist->slug);
        $artist->title = Str::trim($artist->title);
    }
}
