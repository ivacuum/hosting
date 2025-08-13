<?php

namespace App\Http\Controllers;

use App\Action\GetTripsPublishedWithCoverAction;
use App\Collection\LoadTripCityAndCountry;
use App\Domain\Game\Models\Game;

class HomeController
{
    public function __invoke(GetTripsPublishedWithCoverAction $getTripsPublishedWithCover)
    {
        $games = Game::query()
            ->whereNotNull('finished_at')
            ->orderByDesc('finished_at')
            ->limit(6)
            ->get();

        return view('index', [
            'games' => $games,
            'trips' => $getTripsPublishedWithCover
                ->execute(6)
                ->transform(new LoadTripCityAndCountry),
        ]);
    }
}
