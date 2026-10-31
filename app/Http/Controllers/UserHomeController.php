<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserHomeController
{
    public function index(User $traveler)
    {
        abort_unless($traveler->isActive(), 404);

        return redirect(path([UserTravelTripController::class, 'index'], $traveler));
    }
}
