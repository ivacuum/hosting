<?php namespace App\Http\Controllers;

class WanikaniLevelController extends Controller
{
    public function __invoke(int $level)
    {
        \Breadcrumbs::push(trans('japanese.level', ['level' => $level]));

        return view('japanese.wanikani.level', [
            'level' => $level,
            'metaReplace' => ['level' => $level],
        ]);
    }
}
