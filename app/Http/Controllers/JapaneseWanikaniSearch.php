<?php namespace App\Http\Controllers;

use App\Kanji;
use App\Radical;
use App\Vocabulary;

class JapaneseWanikaniSearch extends Controller
{
    public function index()
    {
        $q = request('q');

        if (mb_strlen($q) < 2) {
            return ['status' => 'error_length'];
        }

        $radicals = Radical::where('meaning', 'LIKE', "%{$q}%")
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(['id', 'level', 'character', 'meaning', 'image'])
            ->map(function ($item) {
                /* @var Radical $item */
                return [
                    'id' => $item->id,
                    'slug' => path('JapaneseWanikaniRadicals@show', $item->meaning),
                    'image' => $item->image,
                    'level' => $item->level,
                    'meaning' => $item->meaning,
                    'character' => $item->character,
                ];
            });

        $kanji = Kanji::where('meaning', 'LIKE', "%{$q}%")
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(['id', 'level', 'character', 'meaning', 'onyomi', 'kunyomi', 'important_reading'])
            ->map(function ($item) {
                /* @var Kanji $item */
                return [
                    'id' => $item->id,
                    'slug' => path('JapaneseWanikaniKanji@show', $item->character),
                    'level' => $item->level,
                    'meaning' => $item->meaning,
                    'reading' => $item->importantReading(),
                    'character' => $item->character,
                ];
            });

        $vocabulary = Vocabulary::where('meaning', 'LIKE', "%{$q}%")
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(['id', 'level', 'character', 'kana', 'meaning'])
            ->map(function ($item) {
                /* @var Vocabulary $item */
                return [
                    'id' => $item->id,
                    'kana' => $item->kana,
                    'slug' => path('JapaneseWanikaniVocabulary@show', $item->character),
                    'level' => $item->level,
                    'meaning' => $item->meaning,
                    'character' => $item->character,
                ];
            });

        $count = $radicals->count() + $kanji->count() + $vocabulary->count();

        return compact('count', 'kanji', 'radicals', 'vocabulary');
    }
}
