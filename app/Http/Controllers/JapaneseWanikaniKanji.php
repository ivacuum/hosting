<?php namespace App\Http\Controllers;

use App\Kanji;
use Illuminate\Http\Request;

class JapaneseWanikaniKanji extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani,japanese/wanikani');
    }

    public function index(Request $request)
    {
        $from = max(1, min(60, $request->input('from', 1)));
        $to = min(60, $from + 9);

        \Breadcrumbs::push(trans('japanese.kanji'));

        return view('japanese.wanikani.kanjis', [
            'to' => $to,
            'from' => $from,
        ]);
    }

    public function show(string $character)
    {
        /** @var Kanji $kanji */
        $kanji = Kanji::where('character', $character)
            ->userBurnable(auth()->id())
            ->firstOrFail();

        \Breadcrumbs::push(trans('japanese.level', ['level' => $kanji->level]), "japanese/wanikani/level/{$kanji->level}");
        \Breadcrumbs::push($kanji->character);

        return view('japanese.wanikani.kanji', [
            'kanji' => $kanji,
            'metaReplace' => ['kanji' => $kanji->character],
        ]);
    }
}
