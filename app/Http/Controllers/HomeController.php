<?php namespace App\Http\Controllers;

use App\TripFactory;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('index', ['trips' => TripFactory::tripsWithCover(6)]);
    }
}
