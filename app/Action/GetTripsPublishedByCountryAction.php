<?php

namespace App\Action;

use App\Domain\CacheKey;
use App\Scope\TripPublishedScope;
use App\Trip;
use Illuminate\Cache\Repository;

class GetTripsPublishedByCountryAction
{
    public function __construct(private Repository $cache)
    {
    }

    public function execute(int $countryId = null): array
    {
        $key = CacheKey::TripsPublishedByCountry;

        $ids = $this->cache->remember($key->value, $key->ttl(), function () {
            return Trip::query()
                ->tap(new TripPublishedScope)
                ->with('city:id,country_id')
                ->get(['id', 'city_id'])
                ->mapToGroups(fn (Trip $trip) => [$trip->city->country_id => $trip->id])
                ->toArray();
        });

        if ($countryId) {
            return $ids[$countryId] ?? [];
        }

        return $ids;
    }
}
