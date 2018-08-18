<?php namespace App\Http\Controllers;

use App\Http\Resources\KanjiCollection;
use App\Http\Resources\RadicalCollection;
use App\Http\Resources\VocabularyCollection;
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
            ->get(['id', 'level', 'character', 'meaning', 'image']);

        $kanji = Kanji::where('meaning', 'LIKE', "%{$q}%")
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(['id', 'level', 'character', 'meaning', 'onyomi', 'kunyomi', 'important_reading']);

        $vocabulary = Vocabulary::where('meaning', 'LIKE', "%{$q}%")
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(['id', 'level', 'character', 'kana', 'meaning']);

        return [
            'count' => $radicals->count() + $kanji->count() + $vocabulary->count(),
            'kanji' => new KanjiCollection($kanji),
            'radicals' => new RadicalCollection($radicals),
            'vocabulary' => new VocabularyCollection($vocabulary),
        ];
    }
}
