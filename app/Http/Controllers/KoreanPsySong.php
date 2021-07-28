<?php namespace App\Http\Controllers;

class KoreanPsySong extends Controller
{
    public function __invoke(string $song)
    {
        $tpl = "korean.psy.{$song}";

        \Breadcrumbs::push(\Str::of($song)->replace('-', ' ')->title());

        if (view()->exists($tpl)) {
            return view($tpl, [
                'song' => $song,
                'metaTitle' => \ViewHelper::metaTitle("korean/psy/{$song}"),
            ]);
        }

        abort(404);
    }
}
