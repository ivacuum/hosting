<?php namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Http\Request;

class Trips extends Controller
{
    public function show(Trip $trip, Request $request)
    {
        abort_unless($trip->status->isPublished(), 404);

        return redirect($trip->www($request->input('anchor')));
    }
}
