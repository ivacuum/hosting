<?php namespace App\Http\Controllers;

class About extends Controller
{
    public function __invoke()
    {
        return view('about');
    }
}
