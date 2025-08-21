<?php

namespace App\Domain\Life\Action;

use App\Domain\CacheKey;
use App\Domain\Life\Models\Trip;
use App\Domain\Life\Scope\TripOfAdminScope;
use App\Domain\Life\Scope\TripVisibleScope;
use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetMyVisibleTripsAction
{
    public function __construct(private Repository $cache) {}

    public function execute(string|null $from, string|null $to): Collection
    {
        if (!$from && !$to) {
            $key = CacheKey::MyVisibleTrips;

            return $this->cache->remember(
                $key->value,
                $key->ttl(),
                fn () => $this->findModels($from, $to)
            );
        }

        return $this->findModels($from, $to);
    }

    private function findModels(string|null $from, string|null $to)
    {
        return Trip::query()
            ->withCount('photos')
            ->tap(new TripOfAdminScope)
            ->tap(new TripVisibleScope)
            ->when($from, fn (Builder $query) => $query->where('date_start', '>=', $from))
            ->when($to, fn (Builder $query) => $query->where('date_start', '<=', $to))
            ->get();
    }
}
