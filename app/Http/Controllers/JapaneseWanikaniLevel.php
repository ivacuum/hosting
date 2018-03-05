<?php namespace App\Http\Controllers;

class JapaneseWanikaniLevel extends Controller
{
    public function index()
    {
        \Breadcrumbs::push(trans('japanese.levels'));

        return view('japanese.wanikani.levels');
    }

    public function show(int $level)
    {
        \Breadcrumbs::push(trans('japanese.level', compact('level')));

        return view('japanese.wanikani.level', compact('level'));
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani,japanese/wanikani');
    }
}
