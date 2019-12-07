<?php namespace App\Http\Controllers;

class JapaneseWanikaniLevel extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani,japanese/wanikani');
        $this->middleware('breadcrumbs:japanese.browsing');
    }

    public function index()
    {
        return view('japanese.wanikani.vue');
    }

    public function show(int $level)
    {
        return view('japanese.wanikani.vue', ['metaReplace' => ['level' => $level]]);
    }
}
