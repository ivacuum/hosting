<?php namespace App\Action;

use App\Domain\CacheKey;
use App\Trip;
use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\Collection;

class GetTripsPublishedWithCoverAction
{
    public function __construct(private Repository $cache)
    {
    }

    public function execute(?int $count = null): Collection
    {
        $key = CacheKey::TripsPublishedWithCover;

        return $this->cache->remember($key->value, $key->ttl(), function () {
            return Trip::query()
                ->published()
                ->where('user_id', 1)
                ->where('meta_image', '<>', '')
                ->orderByDesc('date_start')
                ->get();
        })->when($count > 0, function (Collection $trips) use ($count) {
            return $trips->count() > $count
                ? $trips->random($count)
                : $trips;
        });
    }
}