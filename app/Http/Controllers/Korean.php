<?php namespace App\Http\Controllers;

class Korean extends Controller
{
    public function __invoke()
    {
        return view('korean.index');
    }
}
