<?php namespace App\Http\Controllers;

class UserHome extends Controller
{
    public function index(string $login)
    {
        return redirect(path([UserTravelTrips::class, 'index'], $login));
    }
}
