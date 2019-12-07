<?php namespace App\Http\Controllers;

class JapaneseWanikani extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani');
    }

    public function index()
    {
        return view('japanese.wanikani.index');
    }
}
