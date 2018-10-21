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
        $user_id = auth()->id();
        $characters = [];
        $radical_id = request('radical_id');
        $similar_id = request('similar_id');
        $vocabulary_id = request('vocabulary_id');

        $kanji = Kanji::orderBy('level')
            ->orderBy('meaning')
            ->userBurnable($user_id)
            ->when($radical_id, function (Builder $query) use ($radical_id) {
                return $query->whereHas('radicals', function (Builder $query) use ($radical_id) {
                    $query->where('radical_id', $radical_id);
                });
            })
            ->when($similar_id, function (Builder $query) use ($similar_id) {
                return $query->whereHas('similar', function (Builder $query) use ($similar_id) {
                    $query->where('similar_id', $similar_id);
                });
            })
            ->when($level >= 1 && $level <= 60, function (Builder $query) use ($level) {
                return $query->where('level', $level);
            })
            ->when($vocabulary_id, function (Builder $query) use (&$characters, $vocabulary_id) {
                $vocabulary = Vocabulary::findOrFail($vocabulary_id);
                $characters = $vocabulary->splitKanjiCharacters();

                return $query->whereIn('character', $characters);
            })
            ->get(['id', 'level', 'character', 'meaning', 'onyomi', 'kunyomi', 'important_reading'])
            ->when($vocabulary_id, function ($collection) use ($characters) {
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

        return ['status' => 'OK'];
    }

    public function show(string $character)
    {
        if (!request()->wantsJson()) {
            return view('japanese.wanikani.vue', ['meta_replace' => ['kanji' => $character]]);
        }

        $kanji = Kanji::where('character', $character)
            ->userBurnable(auth()->id())
            ->firstOrFail();

        return new KanjiResource($kanji);
    }

    public function update(Kanji $kanji)
    {
        $kanji->resurrect(auth()->id());

        return ['status' => 'OK'];
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani,japanese/wanikani');
        $this->middleware('breadcrumbs:japanese.browsing');
    }
}
