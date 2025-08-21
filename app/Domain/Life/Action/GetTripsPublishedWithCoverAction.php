<?php

namespace App\Domain\Life\Action;

use App\Domain\CacheKey;
use App\Domain\Life\Models\Trip;
use App\Domain\Life\Scope\TripOfAdminScope;
use App\Domain\Life\Scope\TripPublishedScope;
use App\Domain\Life\Scope\TripWithCoverScope;
use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\Collection;

class GetTripsPublishedWithCoverAction
{
    public function __construct(private Repository $cache) {}

    public function execute(int|null $count = null): Collection
    {
        $key = CacheKey::TripsPublishedWithCover;

        return $this->cache->remember($key->value, $key->ttl(), function () {
            return Trip::query()
                ->tap(new TripPublishedScope)
                ->tap(new TripOfAdminScope)
                ->tap(new TripWithCoverScope)
                ->orderByDesc('date_start')
                ->get();
        })->when($count > 0, function (Collection $trips) use ($count) {
            return $trips->count() > $count
                ? $trips->random($count)
                : $trips;
        });
    }
}
