<?php namespace App\Http\Controllers;

class WanikaniLevels extends Controller
{
    public function __invoke()
    {
        return view('japanese.wanikani.levels');
    }
}
