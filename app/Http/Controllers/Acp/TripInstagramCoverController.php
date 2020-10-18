<?php namespace App\Http\Controllers\Acp;

use App\Trip;

class TripInstagramCoverController extends AbstractController
{
    public function __invoke(Trip $trip)
    {
        if (!$trip->meta_image) {
            abort(404);
        }

        return view('acp.trips.instagram-cover', ['trip' => $trip]);
    }

    protected function getModelName(): string
    {
        return Trip::class;
    }
}
