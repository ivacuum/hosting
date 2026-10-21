<?php

namespace App\Http\Controllers;

class KoreanPsySongController
{
    public function __invoke(string $song)
    {
        $tpl = "korean.psy.{$song}";

        \Breadcrumbs::push(str($song)->replace('-', ' ')->title());

        if (view()->exists($tpl)) {
            \Head::title(\ViewHelper::metaTitle("korean/psy/{$song}"));

            return view($tpl, [
                'song' => $song,
            ]);
        }

        abort(404);
    }
}
