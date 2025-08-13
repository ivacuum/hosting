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

    public function forgetGames()
    {
        $this->cache->deleteMultiple([
            CacheKey::GamesFinishedById->value,
        ]);
    }

    public function forgetGigs()
    {
        $this->cache->deleteMultiple([
            CacheKey::MyVisibleGigs->value,
        ]);
    }

    public function forgetMagnets()
    {
        $this->cache->deleteMultiple([
            CacheKey::MagnetStatsByCategories->value,
        ]);
    }

    public function forgetPhotoPoints()
    {
        $this->cache->deleteMultiple([
            CacheKey::PhotosPoints->value,
            CacheKey::PhotosPointsForTrip->value,
        ]);
    }

    public function forgetTrips()
    {
        $this->cache->deleteMultiple([
            CacheKey::MyVisibleTrips->value,
            CacheKey::TripsPublishedByCountry->value,
            CacheKey::TripsPublishedByCity->value,
            CacheKey::TripsPublishedWithCover->value,
        ]);
    }
}
