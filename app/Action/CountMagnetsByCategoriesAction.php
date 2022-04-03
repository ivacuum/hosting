<?php namespace App\Action;

use App\Domain\CacheKey;
use App\Domain\MagnetStatus;
use App\Magnet;
use Illuminate\Cache\Repository;

class CountMagnetsByCategoriesAction
{
    public function __construct(private Repository $cache)
    {
    }

    public function execute()
    {
        return $this->cache->remember(
            CacheKey::TorrentsStatsByCategories->value,
            CacheKey::TorrentsStatsByCategories->ttl(),
            fn () => Magnet::selectRaw('category_id, COUNT(*) AS total')
                ->where('status', MagnetStatus::Published)
                ->groupBy('category_id')
                ->pluck('total', 'category_id')
        );
    }
}
