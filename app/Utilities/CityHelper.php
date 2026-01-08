<?php

namespace App\Utilities;

use App\Domain\CacheKey;
use App\Domain\Life\Models\City;
use Illuminate\Cache\Repository;
use Illuminate\Container\Attributes\Scoped;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

#[Scoped]
class CityHelper
{
    private const array CACHED_FIELDS = [
        'id',
        'country_id',
        'title_ru',
        'title_en',
        'slug',
        'iata',
        'hashtags',
        'point',
    ];

    private Collection|null $cachedById = null;
    private Collection|null $cachedBySlug = null;

    public function __construct(private Repository $cache) {}

    public function cachedById()
    {
        return $this->cache->remember(
            CacheKey::CitiesById,
            CacheKey::CitiesById->ttl(),
            fn () => City::query()
                ->get(self::CACHED_FIELDS)
                ->keyBy('id')
        );
    }

    public function cachedBySlug()
    {
        return $this->cache->remember(
            CacheKey::CitiesBySlug,
            CacheKey::CitiesBySlug->ttl(),
            fn () => City::query()
                ->get(self::CACHED_FIELDS)
                ->keyBy('slug')
        );
    }

    public function findById(int $id): City|null
    {
        if (!isset($this->cachedById[$id])) {
            $this->cachedById = $this->cachedById();
        }

        return $this->cachedById[$id] ?? null;
    }

    public function findByIdOrFail(int $id): City
    {
        return $this->findById($id)
            ?? throw (new ModelNotFoundException)->setModel(City::class, $id);
    }

    public function findBySlug(string|null $slug): City|null
    {
        if (!$slug) {
            return null;
        }

        if (!isset($this->cachedBySlug[$slug])) {
            $this->cachedBySlug = $this->cachedBySlug();
        }

        return $this->cachedBySlug[$slug] ?? null;
    }

    public function findBySlugOrFail(string|null $slug): City
    {
        return $this->findBySlug($slug)
            ?? throw (new ModelNotFoundException)->setModel(City::class, $slug);
    }

    public function title(int|string $q): string|null
    {
        return is_numeric($q)
            ? $this->findById($q)?->title
            : $this->findBySlug($q)?->title;
    }
}
