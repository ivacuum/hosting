<?php

namespace App\Utilities;

use App\Domain\CacheKey;
use App\Domain\Locale;
use Illuminate\Cache\Repository;

class CacheHelper
{
    public function __construct(protected Repository $cache) {}

    public function forgetCities(): void
    {
        $this->cache->deleteMultiple([
            CacheKey::CitiesById,
            CacheKey::CitiesBySlug,
        ]);
    }

    public function forgetCountries(): void
    {
        $this->cache->deleteMultiple([
            CacheKey::CountriesById,
            CacheKey::CountriesBySlug,
        ]);
    }

    public function forgetGames(): void
    {
        $this->cache->deleteMultiple([
            CacheKey::GamesFrontPageById,
        ]);
    }

    public function forgetGigs(): void
    {
        $this->cache->deleteMultiple([
            CacheKey::MyVisibleGigs,
        ]);
    }

    public function forgetMagnets(): void
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

    public function forgetTrips(): void
    {
        $this->cache->deleteMultiple([
            CacheKey::MyVisibleTrips,
            CacheKey::TripsPublishedByCountry,
            CacheKey::TripsPublishedByCity,
            CacheKey::TripsPublishedWithCover,
        ]);
    }

    public function forgetWanikaniVocabularyIds(): void
    {
        $this->cache->deleteMultiple(
            collect(range(1, 60, 10))
                ->map(static fn (int $startLevel) => CacheKey::WanikaniVocabularyIdsByLevels->key($startLevel . '-' . ($startLevel + 9)))
                ->all()
        );
    }
}
