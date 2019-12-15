<?php

use Illuminate\Database\Seeder;

class KanjiSeeder extends Seeder
{
    const KANJI = [
        [
            'level' => 1,
            'nanori' => 'かず',
            'onyomi' => 'いち',
            'kunyomi' => 'ひと',
            'meaning' => 'one',
            'character' => '一',
            'important_reading' => 'onyomi',
        ], [
            'level' => 1,
            'onyomi' => 'に',
            'kunyomi' => 'ふた',
            'meaning' => 'two',
            'character' => '二',
            'important_reading' => 'onyomi',
        ], [
            'level' => 2,
            'onyomi' => 'ご',
            'kunyomi' => 'いつ',
            'meaning' => 'five',
            'character' => '五',
            'important_reading' => 'onyomi',
        ], [
            'level' => 2,
            'onyomi' => 'げつ, がつ',
            'kunyomi' => 'つき',
            'meaning' => 'moon, month',
            'character' => '月',
            'important_reading' => 'onyomi',
        ], [
            'level' => 7,
            'onyomi' => 'じ',
            'kunyomi' => 'とき',
            'meaning' => "time, o'clock, hour",
            'character' => '時',
            'important_reading' => 'onyomi',
        ], [
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
        foreach (self::KANJI as $kanji) {
            /** @var App\Kanji $kanji */
            $kanji = factory(App\Kanji::class)->create($kanji->toArray());

            switch ($kanji->character) {
                case '一':
                case '二':
                    $this->attachRadicals($kanji, ['ground']);
                    break;
                case '月':
                    $this->attachRadicals($kanji, ['moon']);
                    break;
                case '時':
                    $this->attachSimilarKanji($kanji, ['待']);
                    break;
                case '待':
                    $this->attachSimilarKanji($kanji, ['時']);
                    break;
            }
        }
    }

    protected function attachRadicals(App\Kanji $kanji, array $meanings): void
    {
        $kanji->radicals()->sync(App\Radical::whereIn('meaning', $meanings)->get(['id'])->modelKeys());
    }

    protected function attachSimilarKanji(App\Kanji $kanji, array $characters): void
    {
        $kanji->similar()->sync(App\Kanji::whereIn('character', $characters)->get(['id'])->modelKeys());
    }
}
