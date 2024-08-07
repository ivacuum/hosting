<?php

namespace App\Action;

use App\Domain\CacheKey;
use App\Magnet;
use App\Scope\MagnetPublishedScope;
use Illuminate\Cache\Repository;
use Illuminate\Support\Collection;

class CountMagnetsByCategoriesAction
{
    public function __construct(private Repository $cache) {}

    public function execute(): Collection
    {
        return $this->cache->remember(
            CacheKey::MagnetStatsByCategories->value,
            CacheKey::MagnetStatsByCategories->ttl(),
            fn () => Magnet::query()
                ->selectRaw('category_id, COUNT(*) AS total')
                ->tap(new MagnetPublishedScope)
                ->groupBy('category_id')
                ->pluck('total', 'category_id')
        );
    }
}
