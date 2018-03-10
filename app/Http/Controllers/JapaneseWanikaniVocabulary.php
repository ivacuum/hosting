<?php namespace App\Http\Controllers;

use App\Kanji;
use App\Vocabulary as Model;
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
            $vocabulary = Model::orderBy('level')
                ->orderBy('meaning')
                ->userBurnable($user_id)
                ->when($kanji, function (Builder $query) use ($kanji) {
                    return $query->where('character', 'LIKE', "%{$kanji}%");
                })
                ->when($level >= 1 && $level <= 60, function (Builder $query) use ($level) {
                    return $query->where('level', $level);
                })
                ->get(['id', 'level', 'character', 'kana', 'meaning'])
                ->map(function ($item) use ($user_id) {
                    /* @var Model $item */
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
                ->when(!$kanji, function ($collection) {
                    return $collection->groupBy('level');
                });

            return compact('vocabulary');
        }

        return view('japanese.wanikani.vocabularies');
    }

    public function destroy(int $id)
    {
        $vocabulary = Model::findOrFail($id);

        try {
            $vocabulary->burnable()
                ->create(['user_id' => auth()->id()]);
        } catch (QueryException $e) {
        }

        return ['status' => 'OK'];
    }

    public function show(string $characters)
    {
        $vocabulary = Model::where('character', $characters)
            ->userBurnable(auth()->id())
            ->firstOrFail();

        \Breadcrumbs::push($vocabulary->character);

        return view('japanese.wanikani.vocabulary', compact('vocabulary'));
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
        $this->middleware('breadcrumbs:japanese.vocabulary,japanese/wanikani/vocabulary');
    }
}
