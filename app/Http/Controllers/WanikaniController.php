<?php namespace App\Http\Controllers;

class WanikaniController extends Controller
{
    public function __invoke()
    {
        return view('japanese.wanikani.index');
    }
}
