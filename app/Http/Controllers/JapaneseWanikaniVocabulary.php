<?php namespace App\Http\Controllers;

use App\Vocabulary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class JapaneseWanikaniVocabulary extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani,japanese/wanikani');
    }

    public function index(Request $request)
    {
        $from = max(1, min(60, $request->input('from', 1)));
        $to = min(60, $from + 4);

        \Breadcrumbs::push(trans('japanese.vocabulary'));

        return view('japanese.wanikani.vocabularies', [
            'to' => $to,
            'from' => $from,
        ]);
    }

    public function show(string $characters)
    {
        /** @var Vocabulary $vocab */
        $vocab = Vocabulary::where('character', $characters)
            ->userBurnable(auth()->id())
            ->firstOrFail();

        \Breadcrumbs::push(trans('japanese.level', ['level' => $vocab->level]), "japanese/wanikani/level/{$vocab->level}");
        \Breadcrumbs::push($vocab->character);

        return view('japanese.wanikani.vocabulary', [
            'vocab' => $vocab,
            'metaReplace' => ['vocab' => $vocab->character],
        ]);
    }
}
