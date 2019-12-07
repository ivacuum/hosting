<?php namespace App\Http\Controllers;

use App\Http\Resources\Radical as RadicalResource;
use App\Http\Resources\RadicalCollection;
use App\Radical;
use Illuminate\Database\Eloquent\Builder;

class JapaneseWanikaniRadicals extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani,japanese/wanikani');
        $this->middleware('breadcrumbs:japanese.browsing');
    }

    public function index()
    {
        if (!request()->wantsJson()) {
            return view('japanese.wanikani.vue');
        }

        $level = request('level');
        $userId = auth()->id();
        $kanjiId = request('kanji_id');

        $radicals = Radical::orderBy('level')
            ->orderBy('meaning')
            ->userBurnable($userId)
            ->when($kanjiId, function (Builder $query) use ($kanjiId) {
                return $query->whereHas('kanjis', function (Builder $query) use ($kanjiId) {
                    $query->where('kanji_id', $kanjiId);
                });
            })
            ->when($level >= 1 && $level <= 60, function (Builder $query) use ($level) {
                return $query->where('level', $level);
            })
            ->get(['id', 'level', 'character', 'meaning', 'image']);

        return new RadicalCollection($radicals);
    }

    public function destroy(Radical $radical)
    {
        $radical->burn(auth()->id());

        return response()->noContent();
    }

    public function show(string $meaning)
    {
        if (!request()->wantsJson()) {
            return view('japanese.wanikani.vue', ['metaReplace' => ['radical' => $meaning]]);
        }

        $radical = Radical::where('meaning', $meaning)
            ->userBurnable(auth()->id())
            ->firstOrFail();

        return new RadicalResource($radical);
    }

    public function update(Radical $radical)
    {
        $radical->resurrect(auth()->id());

        return response()->noContent();
    }
}
