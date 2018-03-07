<?php namespace App\Http\Controllers;

use App\Kanji as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;

class JapaneseWanikaniKanji extends Controller
{
    public function index()
    {
        $level = request('level');
        $user_id = auth()->id();

        if (request()->ajax()) {
            $kanji = Model::orderBy('level')
                ->orderBy('meaning')
                ->userBurnable($user_id)
                ->when($level >= 1 && $level <= 60, function (Builder $query) use ($level) {
                    return $query->where('level', $level);
                })
                ->get(['id', 'level', 'character', 'meaning', 'onyomi', 'kunyomi', 'important_reading'])
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
                ->groupBy('level');

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
