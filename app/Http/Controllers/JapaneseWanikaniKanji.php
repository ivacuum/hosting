<?php namespace App\Http\Controllers;

use App\Http\Resources\Kanji as KanjiResource;
use App\Http\Resources\KanjiCollection;
use App\Kanji;
use App\Vocabulary;
use Illuminate\Database\Eloquent\Builder;

class JapaneseWanikaniKanji extends Controller
{
    public function index()
    {
        if (!request()->wantsJson()) {
            return view('japanese.wanikani.vue');
        }

        $level = request('level');
        $userId = auth()->id();
        $characters = [];
        $radicalId = request('radical_id');
        $similarId = request('similar_id');
        $vocabularyId = request('vocabulary_id');

        $kanji = Kanji::orderBy('level')
            ->orderBy('meaning')
            ->userBurnable($userId)
            ->when($radicalId, function (Builder $query) use ($radicalId) {
                return $query->whereHas('radicals', function (Builder $query) use ($radicalId) {
                    $query->where('radical_id', $radicalId);
                });
            })
            ->when($similarId, function (Builder $query) use ($similarId) {
                return $query->whereHas('similar', function (Builder $query) use ($similarId) {
                    $query->where('similar_id', $similarId);
                });
            })
            ->when($level >= 1 && $level <= 60, function (Builder $query) use ($level) {
                return $query->where('level', $level);
            })
            ->when($vocabularyId, function (Builder $query) use (&$characters, $vocabularyId) {
                $vocabulary = Vocabulary::findOrFail($vocabularyId);
                $characters = $vocabulary->splitKanjiCharacters();

                return $query->whereIn('character', $characters);
            })
            ->get(['id', 'level', 'character', 'meaning', 'onyomi', 'kunyomi', 'important_reading'])
            ->when($vocabularyId, function ($collection) use ($characters) {
                // Сортировка кандзи в порядке использования в словарном слове
                return $collection->map(function (Kanji $item) use ($characters) {
                    $item->sort = 0;

                    foreach ($characters as $i => $character) {
                        $item->sort = $character === $item->character ? $i * 10 : $item->sort;
                    }

                    return $item;
                })->sortBy('sort')->values();
            });

        return new KanjiCollection($kanji);
    }

    public function destroy(Kanji $kanji)
    {
        $kanji->burn(auth()->id());

        return response()->noContent();
    }

    public function show(string $character)
    {
        if (!request()->wantsJson()) {
            return view('japanese.wanikani.vue', ['metaReplace' => ['kanji' => $character]]);
        }

        $kanji = Kanji::where('character', $character)
            ->userBurnable(auth()->id())
            ->firstOrFail();

        return new KanjiResource($kanji);
    }

    public function update(Kanji $kanji)
    {
        $kanji->resurrect(auth()->id());

        return response()->noContent();
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani,japanese/wanikani');
        $this->middleware('breadcrumbs:japanese.browsing');
    }
}
