<?php namespace App\Utilities;

use App\CacheKey;
use Illuminate\Cache\Repository;

class CacheHelper
{
    public function __construct(protected Repository $cache)
    {
    }

    public function forgetCities()
    {
        $this->cache->deleteMultiple([
            CacheKey::CITIES_BY_ID,
            CacheKey::CITIES_BY_SLUG,
        ]);
    }

    public function forgetCountries()
    {
        $this->cache->deleteMultiple([
            CacheKey::COUNTRIES_BY_ID,
            CacheKey::COUNTRIES_BY_SLUG,
        ]);
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
