<?php namespace App\Http\Controllers;

use App\Trip;

class Home extends Controller
{
    public function index()
    {
        return view('index', ['trips' => Trip::tripsWithCover(6)]);
    }

    public function about()
    {
        return view('about');
    }

    public function cv()
    {
        return view('cv');
    }
}
