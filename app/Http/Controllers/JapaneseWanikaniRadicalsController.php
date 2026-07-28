<?php

namespace App\Http\Controllers;

use App\Domain\Wanikani\Models\Radical;
use App\Domain\Wanikani\Scope\UserBurnableScope;
use App\Http\Requests\WanikaniRadicalIndexForm;

class JapaneseWanikaniRadicalsController
{
    public function index(WanikaniRadicalIndexForm $request)
    {
        return view('japanese.wanikani.radicals', [
            'to' => $request->to,
            'from' => $request->from,
        ]);
    }

    public function show(string $meaning)
    {
        $radical = Radical::query()
            ->where('meaning', $meaning)
            ->tap(new UserBurnableScope(auth()->id()))
            ->sole();

        \Breadcrumbs::push(__('Уровень :level', ['level' => $radical->level]), "japanese/wanikani/level/{$radical->level}");
        \Breadcrumbs::push($radical->meaning);

        return view('japanese.wanikani.radical', [
            'radical' => $radical,
            'metaReplace' => ['radical' => $radical->meaning],
        ]);
    }
}
