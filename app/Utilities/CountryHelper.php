<?php

namespace App\Utilities;

use App\Country;
use App\Domain\CacheKey;
use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CountryHelper
{
    private const CACHED_FIELDS = [
        'id',
        'title_ru',
        'title_en',
        'slug',
        'emoji',
    ];

    private Collection|null $cachedById = null;
    private Collection|null $cachedBySlug = null;

    public function __construct(private Repository $cache)
    {
    }

    public function cachedById()
    {
        $cacheKey = CacheKey::CountriesById;

        return $this->cache->remember(
            $cacheKey->value,
            $cacheKey->ttl(),
            fn () => Country::query()
                ->get(self::CACHED_FIELDS)
                ->keyBy('id')
        );
    }

    public function cachedBySlug()
    {
        $cacheKey = CacheKey::CountriesBySlug;

        return $this->cache->remember(
            $cacheKey->value,
            $cacheKey->ttl(),
            fn () => Country::query()
                ->get(self::CACHED_FIELDS)
                ->keyBy('slug')
        );
    }

    public function findById(int $id): Country|null
    {
        if (!isset($this->cachedById[$id])) {
            $this->cachedById = $this->cachedById();
        }

        return $this->cachedById[$id] ?? null;
    }

    public function findByIdOrFail(int $id): Country
    {
        return $this->findById($id)
            ?? throw (new ModelNotFoundException)->setModel(Country::class, $id);
    }

    public function findBySlug(?string $slug): Country|null
    {
        if (!$slug) {
            return null;
        }

        if (!isset($this->cachedBySlug[$slug])) {
            $this->cachedBySlug = $this->cachedBySlug();
        }

        return $this->cachedBySlug[$slug] ?? null;
    }

    public function findBySlugOrFail(?string $slug): Country
    {
        return $this->findBySlug($slug)
            ?? throw (new ModelNotFoundException)->setModel(Country::class, $slug);
    }

    public function title(int|string $q): string|null
    {
        return is_numeric($q)
            ? $this->findById($q)?->title
            : $this->findBySlug($q)?->title;
    }
}
