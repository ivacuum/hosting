<?php namespace App\Http\Controllers;

use App\Kanji as Model;
use App\Vocabulary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;

class JapaneseWanikaniKanji extends Controller
{
    public function index()
    {
        $level = request('level');
        $user_id = auth()->id();
        $characters = [];
        $radical_id = request('radical_id');
        $similar_id = request('similar_id');
        $vocabulary_id = request('vocabulary_id');

        if (request()->ajax()) {
            $kanji = Model::orderBy('level')
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
                    return $collection->map(function ($item) use ($characters) {
                        /* @var Model $item */
                        $item->sort = 0;

                        foreach ($characters as $i => $character) {
                            $item->sort = $character === $item->character ? $i * 10 : $item->sort;
                        }

                        return $item;
                    })->sortBy('sort')->values();

                })
                ->map(function ($item) use ($user_id) {
                    /* @var Model $item */
                    return [
                        'id' => $item->id,
                        'slug' => path('JapaneseWanikaniKanji@show', $item->character),
                        'level' => $item->level,
                        'burned' => $user_id ? !is_null($item->burnable) : false,
                        'meaning' => $item->firstMeaning(),
                        'reading' => $item->importantReading(),
                        'character' => $item->character,
                    ];
                })
                ->when(!$radical_id && !$similar_id && !$vocabulary_id, function ($collection) {
                    return $collection->groupBy('level');
                });

            return compact('kanji');
        }

        return view('japanese.wanikani.kanjis');
    }

    public function destroy(int $id)
    {
        $model = Model::findOrFail($id);

        try {
            $model->burnable()
                ->create(['user_id' => auth()->id()]);
        } catch (QueryException $e) {
        }

        return ['status' => 'OK'];
    }

    public function show(string $character)
    {
        $kanji = Model::where('character', $character)
            ->userBurnable(auth()->id())
            ->firstOrFail();

        \Breadcrumbs::push($kanji->character);

        return view('japanese.wanikani.kanji', compact('kanji'));
    }

    public function update(int $id)
    {
        $model = Model::findOrFail($id);

        $model->burnable()
            ->where('user_id', auth()->id())
            ->delete();

        return ['status' => 'OK'];
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani,japanese/wanikani');
        $this->middleware('breadcrumbs:japanese.kanji,japanese/wanikani/kanji');
    }
}
