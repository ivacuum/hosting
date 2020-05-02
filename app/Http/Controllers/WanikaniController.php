<?php namespace App\Http\Controllers;

class WanikaniController extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani');
    }

    public function __invoke()
    {
        return view('japanese.wanikani.index');
    }
}
