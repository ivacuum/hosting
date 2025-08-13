<?php

namespace App\Observers;

use App\Domain\Game\Models\Game;
use App\Utilities\CacheHelper;
use Illuminate\Support\Str;

class GameObserver
{
    public function __construct(private CacheHelper $cache) {}

    public function deleted()
    {
        $this->cache->forgetGames();
    }

    public function saved()
    {
        $this->cache->forgetGames();
    }

    public function saving(Game $game)
    {
        $this->maintainConsistency($game);
    }

    private function maintainConsistency(Game $game): void
    {
        if ($game->finished_at?->isBefore($game->released_at)) {
            throw new \DomainException('Game can only be finished after the release date.');
        }

        $game->slug = Str::trim($game->slug);
        $game->title = Str::trim($game->title);
        $game->short_description_en = Str::trim($game->short_description_en);
        $game->short_description_ru = Str::trim($game->short_description_ru);
    }
}
