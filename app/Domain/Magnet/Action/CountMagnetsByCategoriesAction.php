<?php

namespace App\Domain\Magnet\Action;

use App\Domain\CacheKey;
use App\Domain\Magnet\Models\Magnet;
use App\Domain\Magnet\Scope\MagnetPublishedScope;
use Illuminate\Cache\Repository;
use Illuminate\Support\Collection;

class CountMagnetsByCategoriesAction
{
    public function __construct(private Repository $cache) {}

    public function execute(): Collection
    {
        return $this->cache->remember(
            CacheKey::MagnetStatsByCategories,
            CacheKey::MagnetStatsByCategories->ttl(),
            fn (): Collection => Magnet::query()
                ->selectRaw('category_id, COUNT(*) AS total')
                ->tap(new MagnetPublishedScope)
                ->groupBy('category_id')
                ->pluck('total', 'category_id')
        );
    }
}
