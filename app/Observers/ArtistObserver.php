<?php

namespace App\Observers;

use App\Utilities\CacheHelper;

class ArtistObserver
{
    public function __construct(private CacheHelper $cache)
    {
    }

    public function deleted()
    {
        $this->cache->forgetGigs();
    }

    public function saved()
    {
        $this->cache->forgetGigs();
    }
}
