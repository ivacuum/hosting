<?php namespace App\Http\Controllers;

use App\Http\Resources\Vocabulary;
use App\Http\Resources\VocabularyCollection;
use App\Vocabulary as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;

class JapaneseWanikaniVocabulary extends Controller
{
    public function index()
    {
        if (!request()->ajax()) {
            return view('japanese.wanikani.vue');
        }

        $kanji = request('kanji');
        $level = request('level');
        $user_id = auth()->id();

        $vocabulary = Model::orderBy('level')
            ->orderBy('meaning')
            ->userBurnable($user_id)
            ->when($kanji, function (Builder $query) use ($kanji) {
                return $query->where('character', 'LIKE', "%{$kanji}%");
            })
            ->when($level >= 1 && $level <= 60, function (Builder $query) use ($level) {
                return $query->where('level', $level);
            })
            ->get(['id', 'level', 'character', 'kana', 'meaning']);

        return new VocabularyCollection($vocabulary);
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
        if (!request()->ajax()) {
            return view('japanese.wanikani.vue', ['meta_replace' => ['vocab' => $characters]]);
        }

        $vocabulary = Model::where('character', $characters)
            ->userBurnable(auth()->id())
            ->firstOrFail();

        return new Vocabulary($vocabulary);
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
        $this->middleware('breadcrumbs:japanese.browsing');
    }
}
