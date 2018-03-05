<?php namespace App\Http\Controllers;

use App\Kanji;
use App\Vocabulary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;

class JapaneseWanikaniVocabulary extends Controller
{
    public function index()
    {
        $kanji = request('kanji');
        $level = request('level');
        $user_id = auth()->id();

        if (request()->ajax()) {
            $vocabulary = Vocabulary::with('burnable')
                ->orderBy('level')
                ->orderBy('meaning')
                ->when($user_id, function (Builder $query) use ($user_id) {
                    return $query->with(['burnable' => function ($query) use ($user_id) {
                        return $query->where('user_id', $user_id);
                    }]);
                })
                ->when($kanji, function (Builder $query) use ($kanji) {
                    return $query->where('character', 'LIKE', "%{$kanji}%");
                })
                ->when($level >= 1 && $level <= 60, function (Builder $query) use ($level) {
                    return $query->where('level', $level);
                })
                ->get(['id', 'level', 'character', 'kana', 'meaning'])
                ->map(function ($item) use ($user_id) {
                    /* @var Vocabulary $item */
                    return [
                        'id' => $item->id,
                        'kana' => $item->kana,
                        'slug' => path('JapaneseWanikaniVocabulary@show', $item->character),
                        'level' => $item->level,
                        'burned' => $user_id ? !is_null($item->burnable) : false,
                        'meaning' => $item->meaning,
                        'character' => $item->character,
                    ];
                })
                ->groupBy('level');

            return compact('vocabulary');
        }

        return view('japanese.wanikani.vocabularies');
    }

    public function destroy(int $id)
    {
        $vocabulary = Vocabulary::findOrFail($id);

        try {
            $vocabulary->burnable()->create(['user_id' => request()->user()->id]);
        } catch (QueryException $e) {
        }

        return ['status' => 'OK'];
    }

    public function show(string $characters)
    {
        $vocabulary = Vocabulary::where('character', $characters)->firstOrFail();

        \Breadcrumbs::push($vocabulary->character);

        $characters = $vocabulary->splitKanjiCharacters();

        $kanjis = Kanji::whereIn('character', $characters)
            ->get(['id', 'level', 'character', 'meaning', 'onyomi', 'kunyomi', 'important_reading'])
            ->map(function ($item) use ($characters) {
                /* @var Kanji $item */
                $item->sort = 0;

                foreach ($characters as $i => $character) {
                    $item->sort = $character === $item->character ? $i * 10 : $item->sort;
                }

                return $item;
            })
            ->sortBy('sort');

        return view('japanese.wanikani.vocabulary', compact('kanjis', 'vocabulary'));
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani,japanese/wanikani');
        $this->middleware('breadcrumbs:japanese.vocabulary,japanese/wanikani/vocabulary');
    }
}
