<?php namespace App\Http\Controllers;

class Wanikani extends Controller
{
    public function __invoke()
    {
        return view('japanese.wanikani.index');
    }
}
