<?php namespace App\Http\Controllers;

class JapaneseController extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:japanese.index');
    }

    public function __invoke()
    {
        return view('japanese.index');
    }
}
