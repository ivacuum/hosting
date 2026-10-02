<?php

namespace App\Utilities;

use App\Domain\CacheKey;
use App\Domain\Locale;
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
            CacheKey::GamesFrontPageById,
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

    public function forgetMyVisibleTrips(): void
    {
        $this->cache->forget(CacheKey::MyVisibleTrips);
    }

    public function forgetPhotoPoints(): void
    {
        foreach (Locale::cases() as $locale) {
            $this->cache->forget(CacheKey::PhotosPoints->key($locale->value));
        }
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
