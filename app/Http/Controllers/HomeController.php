<?php

namespace App\Http\Controllers;

use App\Action\GetFinishedGameIdsAction;
use App\Action\GetTripsPublishedWithCoverAction;
use App\Collection\LoadTripCityAndCountry;
use App\Domain\Game\Models\Game;

class HomeController
{
    public function __invoke(
        GetTripsPublishedWithCoverAction $getTripsPublishedWithCover,
        GetFinishedGameIdsAction $getFinishedGameIds,
    ) {
        return view('index', [
            'games' => Game::query()
                ->findMany($getFinishedGameIds->execute(6)),
            'trips' => $getTripsPublishedWithCover
                ->execute(6)
                ->transform(new LoadTripCityAndCountry),
        ]);
    }
}
