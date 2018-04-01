<?php namespace App\Http\Controllers;

use App\Kanji;
use Illuminate\Database\QueryException;

class JsSimilarKanji extends Controller
{
    public function index()
    {
        return '';
    }

    public function store()
    {
        request()->validate([
            'kanji' => 'required|max:1',
            'similar' => 'required|max:1',
        ]);

        $kanji = Kanji::where('character', request('kanji'))->firstOrFail();
        $similar = Kanji::where('character', request('similar'))->firstOrFail();

        try {
            $kanji->similar()->attach($similar->id);
        } catch (QueryException $e) {
            return ['status' => 'existed'];
        }

        $ids = $kanji->similar->pluck('id')->push($kanji->id);

        $kanji->similar->each(function (Kanji $item) use ($ids) {
            $item->similar()->sync($ids->filter(function ($id) use ($item) {
                return $item->id !== $id;
            }));
        });

        return ['status' => 'OK'];
    }
}
