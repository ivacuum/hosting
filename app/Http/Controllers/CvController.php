<?php namespace App\Http\Controllers;

class CvController extends Controller
{
    public function __invoke()
    {
        return view('cv');
    }
}
