<?php namespace App\Action;

use App\Domain\CacheKey;
use App\Gig;
use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetMyVisibleGigsAction
{
    public function __construct(private Repository $cache)
    {
    }

    public function execute(?string $from, ?string $to): Collection
    {
        if (!$from && !$to) {
            $key = CacheKey::MyVisibleGigs;

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
        return Gig::with('artist')
            ->when($from, fn (Builder $query) => $query->where('date', '>=', $from))
            ->when($to, fn (Builder $query) => $query->where('date', '<=', $to))
            ->get();
    }
}