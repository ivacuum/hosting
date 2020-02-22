<?php

use App\Factory\VocabularyFactory;
use Illuminate\Database\Seeder;

class VocabularySeeder extends Seeder
{
    const VOCABULARY = [
        [
            'kana' => 'ひとつ',
            'level' => 1,
            'wk_id' => 2468,
            'meaning' => 'one thing',
            'character' => '一つ',
            'sentences' => '',
        ], [
            'kana' => 'いちがつ',
            'level' => 2,
            'wk_id' => 2545,
            'meaning' => 'january',
            'character' => '一月',
            'sentences' => '',
        ], [
            'kana' => 'にがつ',
            'level' => 2,
            'wk_id' => 2544,
            'meaning' => 'february',
            'character' => '二月',
            'sentences' => '',
        ], [
            'kana' => 'ごがつ',
            'level' => 2,
            'wk_id' => 2522,
            'meaning' => 'may',
            'character' => '五月',
            'sentences' => '',
        ], [
            'kana' => 'とき',
            'level' => 7,
            'wk_id' => 2958,
            'meaning' => 'time, hour',
            'character' => '時',
            'sentences' => '',
        ],
    ];

    public function run()
    {
        foreach (self::VOCABULARY as $data) {
            $vocab = VocabularyFactory::new()->make();
            $vocab->kana = $data['kana'];
            $vocab->level = $data['level'];
            $vocab->wk_id = $data['wk_id'];
            $vocab->meaning = $data['meaning'];
            $vocab->character = $data['character'];
            $vocab->sentences = $data['sentences'];
            $vocab->save();
        }
    }
}
