<?php namespace App\Http\Controllers;

use App\Http\Resources\Vocabulary as VocabularyResource;
use App\Http\Resources\VocabularyCollection;
use App\Vocabulary;
use Illuminate\Database\Eloquent\Builder;

class JapaneseWanikaniVocabulary extends Controller
{
    public function index()
    {
        if (!request()->wantsJson()) {
            return view('japanese.wanikani.vue');
        }

        $kanji = request('kanji');
        $level = request('level');
        $user_id = auth()->id();

        $vocabulary = Vocabulary::orderBy('level')
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

    public function destroy(Vocabulary $vocabulary)
    {
        $vocabulary->burn(auth()->id());

        return ['status' => 'OK'];
    }

    public function show(string $characters)
    {
        if (!request()->wantsJson()) {
            return view('japanese.wanikani.vue', ['meta_replace' => ['vocab' => $characters]]);
        }

        $vocabulary = Vocabulary::where('character', $characters)
            ->userBurnable(auth()->id())
            ->firstOrFail();

        return new VocabularyResource($vocabulary);
    }

    public function update(Vocabulary $vocabulary)
    {
        $vocabulary->resurrect(auth()->id());

        return ['status' => 'OK'];
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani,japanese/wanikani');
        $this->middleware('breadcrumbs:japanese.browsing');
    }
}
