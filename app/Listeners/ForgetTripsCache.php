<?php namespace App\Listeners;

use App\CacheKey;
use Illuminate\Cache\Repository;

class ForgetTripsCache
{
    protected $cache;

    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    public function handle()
    {
        $this->cache->deleteMultiple([
            CacheKey::TRIPS_PUBLISHED_BY_COUNTRY,
            CacheKey::TRIPS_PUBLISHED_BY_CITY,
            CacheKey::TRIPS_PUBLISHED_WITH_COVER,
        ]);
    }
}
