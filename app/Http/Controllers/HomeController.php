<?php namespace App\Http\Controllers;

use App\Trip;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('index', ['trips' => Trip::tripsWithCover(6)]);
    }
}
