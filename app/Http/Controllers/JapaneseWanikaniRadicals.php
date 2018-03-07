<?php namespace App\Http\Controllers;

use App\Radical;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;

class JapaneseWanikaniRadicals extends Controller
{
    public function index()
    {
        $level = request('level');
        $user_id = auth()->id();

        if (request()->ajax()) {
            $radicals = Radical::orderBy('level')
                ->orderBy('meaning')
                ->userBurnable($user_id)
                ->when($level >= 1 && $level <= 60, function (Builder $query) use ($level) {
                    return $query->where('level', $level);
                })
                ->get(['id', 'level', 'character', 'meaning', 'image'])
                ->map(function ($item) use ($user_id) {
                    /* @var Radical $item */
                    return [
                        'id' => $item->id,
                        'slug' => path('JapaneseWanikaniRadicals@show', $item->meaning),
                        'image' => $item->image,
                        'level' => $item->level,
                        'burned' => $user_id ? !is_null($item->burnable) : false,
                        'meaning' => $item->meaning,
                        'character' => $item->character,
                    ];
                })
                ->groupBy('level');

            return compact('radicals');
        }

        return view('japanese.wanikani.radicals');
    }

    public function destroy(int $id)
    {
        $radical = Radical::findOrFail($id);

        try {
            $radical->burnable()
                ->create(['user_id' => auth()->id()]);
        } catch (QueryException $e) {
        }

        return ['status' => 'OK'];
    }

    public function show(string $meaning)
    {
        $user_id = auth()->id();

        $radical = Radical::where('meaning', $meaning)
            ->userBurnable($user_id)
            ->firstOrFail();

        \Breadcrumbs::push($radical->meaning);

        return view('japanese.wanikani.radical', compact('radical'));
    }

    public function update(int $id)
    {
        $radical = Radical::findOrFail($id);

        $radical->burnable()
            ->where('user_id', auth()->id())
            ->delete();

        return ['status' => 'OK'];
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.wanikani,japanese/wanikani');
        $this->middleware('breadcrumbs:japanese.radicals,japanese/wanikani/radicals');
    }
}
