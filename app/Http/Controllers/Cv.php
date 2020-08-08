<?php namespace App\Http\Controllers;

class Cv extends Controller
{
    public function __invoke()
    {
        return view('cv');
    }
}
