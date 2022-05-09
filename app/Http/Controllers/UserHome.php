<?php namespace App\Http\Controllers;

use App\User;

class UserHome
{
    public function index(User $traveler)
    {
        return redirect(path([UserTravelTrips::class, 'index'], $traveler));
    }
}
