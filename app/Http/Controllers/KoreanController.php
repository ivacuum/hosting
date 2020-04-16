<?php namespace App\Http\Controllers;

class KoreanController extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:korean.index');
    }

    public function __invoke()
    {
        return view('korean.index');
    }
}
