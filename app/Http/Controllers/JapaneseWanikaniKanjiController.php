<?php

namespace App\Http\Controllers;

use App\Domain\Wanikani\Models\Kanji;
use App\Domain\Wanikani\Scope\UserBurnableScope;
use App\Http\Requests\WanikaniKanjiIndexForm;

class JapaneseWanikaniKanjiController
{
    public function index(WanikaniKanjiIndexForm $request)
    {
        return view('japanese.wanikani.kanjis', [
            'to' => $request->to,
            'from' => $request->from,
        ]);
    }

    public function show(string $character)
    {
        $kanji = Kanji::query()
            ->where('character', $character)
            ->tap(new UserBurnableScope(auth()->id()))
            ->sole();

        \Breadcrumbs::push(__('Уровень :level', ['level' => $kanji->level]), "japanese/wanikani/level/{$kanji->level}");
        \Breadcrumbs::push($kanji->character);

        return view('japanese.wanikani.kanji', [
            'kanji' => $kanji,
            'metaReplace' => ['kanji' => $kanji->character],
        ]);
    }
}
