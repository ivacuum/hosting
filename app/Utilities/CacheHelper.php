<?php namespace App\Utilities;

use App\CacheKey;
use Illuminate\Cache\Repository;

class CacheHelper
{
    protected $cache;

    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    public function forgetTrips()
    {
        $this->cache->deleteMultiple([
            CacheKey::TRIPS_PUBLISHED_BY_COUNTRY,
            CacheKey::TRIPS_PUBLISHED_BY_CITY,
            CacheKey::TRIPS_PUBLISHED_WITH_COVER,
        ]);
    }
}
