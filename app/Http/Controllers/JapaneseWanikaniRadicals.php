<?php namespace App\Http\Controllers;

use App\Radical;
use App\Scope\UserBurnableScope;
use Illuminate\Http\Request;

class JapaneseWanikaniRadicals
{
    public function index(Request $request)
    {
        $from = max(1, min(60, $request->input('from', 1)));
        $to = min(60, $from + 9);

        return view('japanese.wanikani.radicals', [
            'to' => $to,
            'from' => $from,
        ]);
    }

    public function show(string $meaning)
    {
        /** @var Radical $radical */
        $radical = Radical::query()
            ->where('meaning', $meaning)
            ->tap(new UserBurnableScope(auth()->id()))
            ->firstOrFail();

        \Breadcrumbs::push(__('Уровень :level', ['level' => $radical->level]), "japanese/wanikani/level/{$radical->level}");
        \Breadcrumbs::push($radical->meaning);

        return view('japanese.wanikani.radical', [
            'radical' => $radical,
            'metaReplace' => ['radical' => $radical->meaning],
        ]);
    }
}
