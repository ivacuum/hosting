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
        $this->cache->forget(CacheKey::TRIPS_PUBLISHED_BY_COUNTRY);
        $this->cache->forget(CacheKey::TRIPS_PUBLISHED_BY_CITY);
        $this->cache->forget(CacheKey::TRIPS_PUBLISHED_WITH_COVER);
    }
}
