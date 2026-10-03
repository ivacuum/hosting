<?php

namespace App\Domain\Life\Action;

use App\Domain\CacheKey;
use App\Domain\Life\Models\Trip;
use App\Domain\Life\Scope\TripOfAdminScope;
use App\Domain\Life\Scope\TripPublishedScope;
use App\Domain\Life\Scope\TripWithCoverScope;
use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class GetTripsPublishedWithCoverAction
{
    public function __construct(private Repository $cache) {}

    public function execute(int|null $count = null): Collection
    {
        $key = CacheKey::TripsPublishedWithCover;

        $ids = $this->cache->remember($key, $key->ttl(), static function (): array {
            return Trip::query()
                ->tap(new TripPublishedScope)
                ->tap(new TripOfAdminScope)
                ->tap(new TripWithCoverScope)
                ->pluck('id')
                ->all();
        });

        if ($count > 0 && count($ids) > $count) {
            $ids = Arr::random($ids, $count);
        }

        return Trip::query()
            ->whereKey($ids)
            ->orderByDesc('date_start')
            ->get();
    }
}
