<?php

namespace App\Http\Controllers;

class WanikaniLevelController
{
    public function __invoke(int $level)
    {
        \Breadcrumbs::push(__('Уровень :level', ['level' => $level]));

        \Head::title(\ViewHelper::metaTitle('japanese/wanikani/level/{level}', ['level' => $level]));

        return view('japanese.wanikani.level', [
            'level' => $level,
        ]);
    }
}
