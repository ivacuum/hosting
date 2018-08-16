<?php namespace App\Http\Controllers;

use App\Http\Resources\Radical;
use App\Http\Resources\RadicalCollection;
use App\Radical as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;

class JapaneseWanikaniRadicals extends Controller
{
    public function index()
    {
        if (!request()->ajax()) {
            return view('japanese.wanikani.vue');
        }

        $level = request('level');
        $user_id = auth()->id();
        $kanji_id = request('kanji_id');

        $radicals = Model::orderBy('level')
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

    public function show(string $meaning)
    {
        if (!request()->ajax()) {
            return view('japanese.wanikani.vue', ['meta_replace' => ['radical' => $meaning]]);
        }

        $radical = Model::where('meaning', $meaning)
            ->userBurnable(auth()->id())
            ->firstOrFail();

        return new Radical($radical);
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
