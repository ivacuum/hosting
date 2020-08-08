<?php namespace App\Http\Controllers;

class Japanese extends Controller
{
    public function __invoke()
    {
        return view('japanese.index');
    }
}
