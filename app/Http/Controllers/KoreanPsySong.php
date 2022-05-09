<?php namespace App\Http\Controllers;

class KoreanPsySong
{
    public function __invoke(string $song)
    {
        $tpl = "korean.psy.{$song}";

        \Breadcrumbs::push(str($song)->replace('-', ' ')->title());

        if (view()->exists($tpl)) {
            return view($tpl, [
                'song' => $song,
                'metaTitle' => \ViewHelper::metaTitle("korean/psy/{$song}"),
            ]);
        }

        abort(404);
    }
}
