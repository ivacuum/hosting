<?php

namespace App\Http\Controllers;

use App\Kanji;
use App\Scope\UserBurnableScope;
use Illuminate\Http\Request;

class JapaneseWanikaniKanjiController
{
    public function index(Request $request)
    {
        $from = max(1, min(60, $request->input('from', 1)));
        $to = min(60, $from + 9);

        return view('japanese.wanikani.kanjis', [
            'to' => $to,
            'from' => $from,
        ]);
    }

    public function show(string $character)
    {
        /** @var Kanji $kanji */
        $kanji = Kanji::query()
            ->where('character', $character)
            ->tap(new UserBurnableScope(auth()->id()))
            ->firstOrFail();

        \Breadcrumbs::push(__('Уровень :level', ['level' => $kanji->level]), "japanese/wanikani/level/{$kanji->level}");
        \Breadcrumbs::push($kanji->character);

        return view('japanese.wanikani.kanji', [
            'kanji' => $kanji,
            'metaReplace' => ['kanji' => $kanji->character],
        ]);
    }
}
