<?php namespace App\Http\Controllers;

class Retracker extends Controller
{
    public function index()
    {
        return view('retracker.index');
    }

    public function dev()
    {
        return view('retracker.dev');
    }

    public function usage()
    {
        return view('retracker.usage');
    }
}
