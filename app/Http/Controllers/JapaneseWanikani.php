<?php namespace App\Http\Controllers;

class JapaneseWanikani extends Controller
{
    public function index()
    {
        return view('japanese.wanikani.index');
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani');
    }
}
