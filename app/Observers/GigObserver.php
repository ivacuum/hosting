<?php

namespace App\Observers;

use App\Utilities\CacheHelper;

class GigObserver
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
