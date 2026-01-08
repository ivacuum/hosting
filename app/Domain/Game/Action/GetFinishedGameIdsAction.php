<?php

namespace App\Domain\Game\Action;

use App\Domain\CacheKey;
use App\Domain\Game\Models\Game;
use Illuminate\Cache\Repository;
use Illuminate\Support\Collection;

class GetFinishedGameIdsAction
{
    public function __construct(private Repository $cache) {}

    public function execute(int|null $count = null): Collection
    {
        return $this
            ->cache
            ->remember(
                CacheKey::GamesFinishedById,
                CacheKey::GamesFinishedById->ttl(),
                function () {
                    return Game::query()
                        ->whereNotNull('finished_at')
                        ->orderByDesc('finished_at')
                        ->pluck('id');
                })
            ->when($count > 0, function (Collection $games) use ($count) {
                return $games->count() > $count
                    ? $games->random($count)
                    : $games;
            });
    }
}
