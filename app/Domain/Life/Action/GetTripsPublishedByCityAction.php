<?php

namespace App\Domain\Life\Action;

use App\Domain\CacheKey;
use App\Domain\Life\Models\Trip;
use App\Domain\Life\Scope\TripPublishedScope;
use Illuminate\Cache\Repository;

class GetTripsPublishedByCityAction
{
    public function __construct(private Repository $cache) {}

    public function execute(int|null $cityId = null): array
    {
        $key = CacheKey::TripsPublishedByCity;

        $ids = $this->cache->remember($key->value, $key->ttl(), function () {
            return Trip::query()
                ->tap(new TripPublishedScope)
                ->get(['id', 'city_id'])
                ->mapToGroups(fn (Trip $trip) => [$trip->city_id => $trip->id])
                ->toArray();
        });

        if ($cityId) {
            return $ids[$cityId] ?? [];
        }

        return $ids;
    }
}
