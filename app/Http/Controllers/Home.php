<?php namespace App\Http\Controllers;

class Home extends Controller
{
    public function index()
    {
        return view('index');
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
