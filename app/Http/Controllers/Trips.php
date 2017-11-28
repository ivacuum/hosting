<?php namespace App\Http\Controllers;

use App\Trip;

class Trips extends Controller
{
    public function show(Trip $trip)
    {
        abort_unless($trip->status === Trip::STATUS_PUBLISHED, 404);

        return redirect($trip->www(request('anchor')));
    }
}
