<?php namespace App\Http\Controllers;

use App\Http\Resources\Radical as RadicalResource;
use App\Http\Resources\RadicalCollection;
use App\Radical;
use Illuminate\Database\Eloquent\Builder;

class JapaneseWanikaniRadicals extends Controller
{
    public function index()
    {
        if (!request()->wantsJson()) {
            return view('japanese.wanikani.vue');
        }

        $level = request('level');
        $user_id = auth()->id();
        $kanji_id = request('kanji_id');

        $radicals = Radical::orderBy('level')
            ->orderBy('meaning')
            ->userBurnable($user_id)
            ->when($kanji_id, function (Builder $query) use ($kanji_id) {
                return $query->whereHas('kanjis', function (Builder $query) use ($kanji_id) {
                    $query->where('kanji_id', $kanji_id);
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

        return ['status' => 'OK'];
    }

    public function show(string $meaning)
    {
        if (!request()->wantsJson()) {
            return view('japanese.wanikani.vue', ['meta_replace' => ['radical' => $meaning]]);
        }

        $radical = Radical::where('meaning', $meaning)
            ->userBurnable(auth()->id())
            ->firstOrFail();

        return new RadicalResource($radical);
    }

    public function update(Radical $radical)
    {
        $radical->resurrect(auth()->id());

        return ['status' => 'OK'];
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani,japanese/wanikani');
        $this->middleware('breadcrumbs:japanese.browsing');
    }
}
