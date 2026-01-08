<?php

namespace App\Utilities;

use App\Domain\CacheKey;
use Illuminate\Cache\Repository;

class CacheHelper
{
    public function __construct(protected Repository $cache) {}

    public function forgetCities()
    {
        $this->cache->deleteMultiple([
            CacheKey::CitiesById,
            CacheKey::CitiesBySlug,
        ]);
    }

    public function forgetCountries()
    {
        $this->cache->deleteMultiple([
            CacheKey::CountriesById,
            CacheKey::CountriesBySlug,
        ]);
    }

    public function forgetGames()
    {
        $this->cache->deleteMultiple([
            CacheKey::GamesFinishedById,
        ]);
    }

    public function forgetGigs()
    {
        $this->cache->deleteMultiple([
            CacheKey::MyVisibleGigs,
        ]);
    }

    public function forgetMagnets()
    {
        $this->cache->deleteMultiple([
            CacheKey::MagnetStatsByCategories,
        ]);
    }

    public function forgetPhotoPoints()
    {
        $this->cache->deleteMultiple([
            CacheKey::PhotosPoints,
            CacheKey::PhotosPointsForTrip,
        ]);
    }

    public function forgetTrips()
    {
        $this->cache->deleteMultiple([
            CacheKey::MyVisibleTrips,
            CacheKey::TripsPublishedByCountry,
            CacheKey::TripsPublishedByCity,
            CacheKey::TripsPublishedWithCover,
        ]);
    }
}
