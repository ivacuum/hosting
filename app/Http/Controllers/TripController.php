<?php

namespace App\Http\Controllers;

use App\Domain\Life\Models\Trip;
use App\Http\Requests\TripShowForm;

class TripController
{
    public function show(Trip $trip, TripShowForm $request)
    {
        abort_unless($trip->status->isPublished(), 404);

        return redirect($trip->www($request->anchor));
    }
}
