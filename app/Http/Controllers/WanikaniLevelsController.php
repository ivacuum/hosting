<?php namespace App\Http\Controllers;

class WanikaniLevelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani,japanese/wanikani');
        $this->middleware('breadcrumbs:japanese.levels');
    }

    public function __invoke()
    {
        return view('japanese.wanikani.levels');
    }
}
