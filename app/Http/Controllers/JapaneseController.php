<?php namespace App\Http\Controllers;

class JapaneseController extends Controller
{
    public function __invoke()
    {
        return view('japanese.index');
    }
}
