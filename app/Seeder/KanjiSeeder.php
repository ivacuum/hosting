<?php namespace App\Seeder;

use App\Factory\KanjiFactory;
use App\Kanji;
use App\Radical;
use Illuminate\Database\Seeder;

class KanjiSeeder extends Seeder
{
    private const KANJI = [
        [
            'level' => 1,
            'nanori' => 'かず',
            'onyomi' => 'いち',
            'kunyomi' => 'ひと',
            'meaning' => 'one',
            'character' => '一',
            'important_reading' => 'onyomi',
        ],
        [
            'level' => 1,
            'onyomi' => 'に',
            'kunyomi' => 'ふた',
            'meaning' => 'two',
            'character' => '二',
            'important_reading' => 'onyomi',
        ],
        [
            'level' => 2,
            'onyomi' => 'ご',
            'kunyomi' => 'いつ',
            'meaning' => 'five',
            'character' => '五',
            'important_reading' => 'onyomi',
        ],
        [
            'level' => 2,
            'onyomi' => 'げつ, がつ',
            'kunyomi' => 'つき',
            'meaning' => 'moon, month',
            'character' => '月',
            'important_reading' => 'onyomi',
        ],
        [
            'level' => 7,
            'onyomi' => 'じ',
            'kunyomi' => 'とき',
            'meaning' => "time, o'clock, hour",
            'character' => '時',
            'important_reading' => 'onyomi',
        ],
        [
            'level' => 9,
            'onyomi' => 'たい',
            'kunyomi' => 'ま',
            'meaning' => 'wait',
            'character' => '待',
            'important_reading' => 'kunyomi',
        ],
    ];

    public function run()
    {
        foreach (self::KANJI as $data) {
            $kanji = KanjiFactory::new()->make();
            $kanji->level = $data['level'];
            $kanji->nanori = $data['nanori'] ?? '';
            $kanji->onyomi = $data['onyomi'];
            $kanji->kunyomi = $data['kunyomi'];
            $kanji->meaning = $data['meaning'];
            $kanji->character = $data['character'];
            $kanji->important_reading = $data['important_reading'];
            $kanji->save();
        }

        Kanji::each(function (Kanji $kanji) {
            match ($kanji->character) {
                '一',
                '二' => $this->attachRadicals($kanji, ['ground']),
                '月' => $this->attachRadicals($kanji, ['moon']),
                '時' => $this->attachSimilarKanji($kanji, ['待']),
                '待' => $this->attachSimilarKanji($kanji, ['時']),
                default => null,
            };
        });
    }

    private function attachRadicals(Kanji $kanji, array $meanings): void
    {
        $kanji->radicals()->sync(Radical::whereIn('meaning', $meanings)->pluck('id'));
    }

    private function attachSimilarKanji(Kanji $kanji, array $characters): void
    {
        $kanji->similar()->sync(Kanji::whereIn('character', $characters)->pluck('id'));
    }
}
