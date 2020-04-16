<?php namespace App\Http\Controllers;

class KoreanPsySongController extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:korean.index,korean');
        $this->middleware('breadcrumbs:korean.psy,korean/psy');
    }

    public function __invoke(string $song)
    {
        $tpl = "korean.psy.{$song}";

        \Breadcrumbs::push(\Str::of($song)->replace('-', ' ')->title());

        if (view()->exists($tpl)) {
            return view($tpl, [
                'song' => $song,
                'metaTitle' => \ViewHelper::metaTitle("korean-psy-{$song}"),
            ]);
        }
    }
}
