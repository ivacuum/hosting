<?php

namespace App\Http\Controllers;

use App\Domain\Game\Action\GetFrontPageGameIdsAction;
use App\Domain\Game\Models\Game;
use App\Domain\Life\Action\GetTripsPublishedWithCoverAction;
use App\Domain\Life\Collection\LoadTripCityAndCountry;

class HomeController
{
    public function __invoke(
        GetTripsPublishedWithCoverAction $getTripsPublishedWithCover,
        GetFrontPageGameIdsAction $getFrontPageGameIds,
    ) {
        return view('index', [
            'games' => Game::query()
                ->findMany($getFrontPageGameIds->execute(6)),
            'trips' => $getTripsPublishedWithCover
                ->execute(6)
                ->transform(new LoadTripCityAndCountry),
        ]);
    }
}
