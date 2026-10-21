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
            'radicals' => Radical::query()
                ->whereBetween('level', [$request->from, $request->to])
                ->orderBy('level')
                ->orderBy('meaning')
                ->get(Radical::LIST_COLUMNS)
                ->groupBy('level'),
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

        \Head::title(\ViewHelper::metaTitle('japanese/wanikani/radicals/{meaning}', ['radical' => $radical->meaning]));

        return view('japanese.wanikani.radical', [
            'radical' => $radical,
        ]);
    }
}
