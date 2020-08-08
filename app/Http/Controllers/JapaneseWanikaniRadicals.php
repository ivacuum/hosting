<?php namespace App\Http\Controllers;

use App\Radical;
use Illuminate\Http\Request;

class JapaneseWanikaniRadicals extends Controller
{
    public function index(Request $request)
    {
        $from = max(1, min(60, $request->input('from', 1)));
        $to = min(60, $from + 9);

        \Breadcrumbs::push(trans('japanese.radicals'));

        return view('japanese.wanikani.radicals', [
            'to' => $to,
            'from' => $from,
        ]);
    }

    public function show(string $meaning)
    {
        /** @var Radical $radical */
        $radical = Radical::where('meaning', $meaning)
            ->userBurnable(auth()->id())
            ->firstOrFail();

        \Breadcrumbs::push(trans('japanese.level', ['level' => $radical->level]), "japanese/wanikani/level/{$radical->level}");
        \Breadcrumbs::push($radical->meaning);

        return view('japanese.wanikani.radical', [
            'radical' => $radical,
            'metaReplace' => ['radical' => $radical->meaning],
        ]);
    }
}
