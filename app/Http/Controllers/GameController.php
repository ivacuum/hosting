<?php

namespace App\Http\Controllers;

use App\Domain\Game\Models\Game;
use Laravel\Head\Enums\OgType;

class GameController
{
    public function index()
    {
        $games = Game::query()
            ->orderByDesc('released_at')
            ->paginate(25);

        return view('games.index', [
            'games' => $games,
        ]);
    }

    public function show(Game $game)
    {
        \Breadcrumbs::push($game->title);

        $reviewTpl = "life.games.{$game->slug}";

        \Head::title($game->title)
            ->og(
                type: OgType::Article,
                image: $game->libraryImage(),
            );

        return view('games.show', [
            'game' => $game,
            'slug' => "games/{$game->slug}", // Базовый путь для скриншотов
            'reviewTpl' => view()->exists($reviewTpl)
                ? $reviewTpl
                : null,
        ]);
    }
}
