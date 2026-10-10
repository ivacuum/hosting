<?php

namespace App\Domain\Life\Action;

use App\Domain\CacheKey;
use App\Domain\Life\Models\Gig;
use Carbon\CarbonImmutable;
use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetMyVisibleGigsAction
{
    public function __construct(private Repository $cache) {}

    public function execute(CarbonImmutable|null $from, CarbonImmutable|null $to): Collection
    {
        if (!$from && !$to) {
            return $this->cache->remember(
                CacheKey::MyVisibleGigs,
                CacheKey::MyVisibleGigs->ttl(),
                fn (): Collection => $this->findModels($from, $to)
            );
        }

        return $this->findModels($from, $to);
    }

    private function findModels(CarbonImmutable|null $from, CarbonImmutable|null $to): Collection
    {
        return Gig::query()
            ->with('artist')
            ->when($from, static fn (Builder $query) => $query->where('date', '>=', $from))
            ->when($to, static fn (Builder $query) => $query->where('date', '<=', $to))
            ->get();
    }
}
