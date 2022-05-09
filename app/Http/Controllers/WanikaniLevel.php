<?php namespace App\Http\Controllers;

class WanikaniLevel
{
    public function __invoke(int $level)
    {
        \Breadcrumbs::push(__('Уровень :level', ['level' => $level]));

        return view('japanese.wanikani.level', [
            'level' => $level,
            'metaReplace' => ['level' => $level],
        ]);
    }
}
