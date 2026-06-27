<?php

namespace App\Domain\Game\Action;

use App\Domain\CacheKey;
use App\Domain\Game\Models\Game;
use Illuminate\Cache\Repository;
use Illuminate\Support\Collection;

class GetFrontPageGameIdsAction
{
    public function __construct(private Repository $cache) {}

    public function execute(int|null $count = null): Collection
    {
        return $this
            ->cache
            ->remember(
                CacheKey::GamesFrontPageById,
                CacheKey::GamesFrontPageById->ttl(),
                static function () {
                    return Game::query()->pluck('id');
                })
            ->when($count > 0, static function (Collection $games) use ($count) {
                return $games->count() > $count
                    ? $games->random($count)
                    : $games;
            });
    }
}