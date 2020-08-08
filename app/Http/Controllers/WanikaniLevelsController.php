<?php namespace App\Http\Controllers;

class WanikaniLevelsController extends Controller
{
    public function __invoke()
    {
        return view('japanese.wanikani.levels');
    }
}
