<?php namespace App\Action;

use App\Domain\CacheKey;
use App\Scope\TripVisibleScope;
use App\Trip;
use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetMyVisibleTripsAction
{
    public function __construct(private Repository $cache)
    {
    }

    public function execute(?string $from, ?string $to): Collection
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

    private function findModels(?string $from, ?string $to)
    {
        return Trip::withCount('photos')
            ->where('user_id', 1)
            ->tap(new TripVisibleScope)
            ->when($from, fn (Builder $query) => $query->where('date_start', '>=', $from))
            ->when($to, fn (Builder $query) => $query->where('date_start', '<=', $to))
            ->get();
    }
}
