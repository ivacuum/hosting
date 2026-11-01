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
        $this->forget(
            CacheKey::CitiesById,
            CacheKey::CitiesBySlug,
        );
    }

    public function forgetCountries(): void
    {
        $this->forget(
            CacheKey::CountriesById,
            CacheKey::CountriesBySlug,
        );
    }

    public function forgetGames(): void
    {
        $this->forget(CacheKey::GamesFrontPageById);
    }

    public function forgetGigs(): void
    {
        $this->forget(CacheKey::MyVisibleGigs);
    }

    public function forgetMagnets(): void
    {
        $this->forget(CacheKey::MagnetStatsByCategories);
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
        $this->forget(
            CacheKey::MyVisibleTrips,
            CacheKey::TripsPublishedByCountry,
            CacheKey::TripsPublishedByCity,
            CacheKey::TripsPublishedWithCover,
        );
    }

    public function forgetWanikaniVocabularyIds(): void
    {
        $this->cache->deleteMultiple(
            collect(range(1, 60, 10))
                ->map(static fn (int $startLevel) => CacheKey::WanikaniVocabularyIdsByLevels->key($startLevel . '-' . ($startLevel + 9)))
                ->all()
        );
    }

    private function forget(CacheKey ...$keys): void
    {
        foreach ($keys as $key) {
            $this->cache->forget($key);
        }
    }
}
