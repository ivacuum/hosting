<?php namespace App\Utilities;

use App\Domain\CacheKey;
use Illuminate\Cache\Repository;

class CacheHelper
{
    public function __construct(protected Repository $cache)
    {
    }

    public function forgetCities()
    {
        $this->cache->deleteMultiple([
            CacheKey::CitiesById->value,
            CacheKey::CitiesBySlug->value,
        ]);
    }

    public function forgetCountries()
    {
        $this->cache->deleteMultiple([
            CacheKey::CountriesById->value,
            CacheKey::CountriesBySlug->value,
        ]);
    }

    public function forgetTrips()
    {
        $this->cache->deleteMultiple([
            CacheKey::TripsPublishedByCountry->value,
            CacheKey::TripsPublishedByCity->value,
            CacheKey::TripsPublishedWithCover->value,
        ]);
    }
}
