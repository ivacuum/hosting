<?php namespace App\Http\Controllers;

use App\Trip;

class Home extends Controller
{
    public function index()
    {
        $trips = Trip::where('user_id', 1)
            ->where('status', Trip::STATUS_PUBLISHED)
            ->where('meta_image', '<>', '')
            ->take(3)
            ->inRandomOrder()
            ->get();

        return view('index', compact('trips'));
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
