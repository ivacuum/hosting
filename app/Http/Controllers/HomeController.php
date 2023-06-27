<?php

namespace App\Http\Controllers;

use App\Action\GetTripsPublishedWithCoverAction;

class HomeController
{
    public function __invoke(GetTripsPublishedWithCoverAction $getTripsPublishedWithCover)
    {
        return view('index', ['trips' => $getTripsPublishedWithCover->execute(6)]);
    }
}
