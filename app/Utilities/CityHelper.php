<?php namespace App\Utilities;

use App\City;
use App\Domain\CacheKey;
use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CityHelper
{
    private const CACHED_FIELDS = [
        'id',
        'country_id',
        'title_ru',
        'title_en',
        'slug',
        'iata',
        'point',
    ];

    private Collection|null $cachedById = null;
    private Collection|null $cachedBySlug = null;

    public function __construct(private Repository $cache)
    {
    }

    public function cachedById()
    {
        $cacheKey = CacheKey::CitiesById;

        return $this->cache->remember(
            $cacheKey->value,
            $cacheKey->ttl(),
            fn () => City::query()
                ->get(self::CACHED_FIELDS)
                ->keyBy('id')
        );
    }

    public function cachedBySlug()
    {
        $cacheKey = CacheKey::CitiesBySlug;

        return $this->cache->remember(
            $cacheKey->value,
            $cacheKey->ttl(),
            fn () => City::query()
                ->get(self::CACHED_FIELDS)
                ->keyBy('slug')
        );
    }

    public function findById(int $id): ?City
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

    public function findBySlug(?string $slug): ?City
    {
        if (!$slug) {
            return null;
        }

        if (!isset($this->cachedBySlug[$slug])) {
            $this->cachedBySlug = $this->cachedBySlug();
        }

        return $this->cachedBySlug[$slug] ?? null;
    }

    public function findBySlugOrFail(?string $slug): City
    {
        return $this->findBySlug($slug)
            ?? throw (new ModelNotFoundException)->setModel(City::class, $slug);
    }

    public function title(int|string $q): ?string
    {
        return is_numeric($q)
            ? $this->findById($q)?->title
            : $this->findBySlug($q)?->title;
    }
}
