<?php namespace App\Http\Controllers;

use App\User;

class UserHomeController
{
    public function index(User $traveler)
    {
        return redirect(path([UserTravelTripController::class, 'index'], $traveler));
    }
}
