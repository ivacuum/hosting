<?php

namespace App\Domain\Wanikani\Seeder;

use App\Domain\Wanikani\Models\Vocabulary;
use Illuminate\Database\Seeder;

class VocabularySeeder extends Seeder
{
    private const array VOCABULARY = [
        [
            'kana' => 'ひとつ',
            'level' => 1,
            'wk_id' => 2468,
            'meaning' => 'one thing',
            'character' => '一つ',
            'sentences' => '',
            'male_audio' => 'vz0nsb17j90pyvz7voewcqgrd6i1',
            'female_audio' => 'q46n27v32n0jtasq8i0pwyh7cwin',
        ],
        [
            'kana' => 'いちがつ',
            'level' => 2,
            'wk_id' => 2544,
            'meaning' => 'january',
            'character' => '一月',
            'sentences' => '',
            'male_audio' => 'gb0ppu80undtuzdgt8qxgy7eb198',
            'female_audio' => 'd5ry7kh50ra25wqm4fpmah8d4taq',
        ],
        [
            'kana' => 'にがつ',
            'level' => 2,
            'wk_id' => 2545,
            'meaning' => 'february',
            'character' => '二月',
            'sentences' => '',
            'male_audio' => 'bsivty414zfac0gknvjxr4ei8rdl',
            'female_audio' => 'bghrqmo1564vipug0n5slvkhvspg',
        ],
        [
            'kana' => 'ごがつ',
            'level' => 2,
            'wk_id' => 2522,
            'meaning' => 'may',
            'character' => '五月',
            'sentences' => '',
            'male_audio' => 'y3islg64cdpd7ztxrv58ix1jpwlj',
            'female_audio' => 'dwrjf1ofktz107d8q1da2oido03j',
        ],
        [
            'kana' => 'とき',
            'level' => 7,
            'wk_id' => 2958,
            'meaning' => 'time, hour',
            'character' => '時',
            'sentences' => '',
            'male_audio' => 'k2qsiwhnxvra7rwmrfqwievghkrn',
            'female_audio' => 'g4drd357bb8zzk58rs780eitqwqo',
        ],
    ];

    public function run()
    {
        foreach (self::VOCABULARY as [
            'kana' => $kana,
            'level' => $level,
            'wk_id' => $wkId,
            'meaning' => $meaning,
            'character' => $character,
            'sentences' => $sentences,
            'male_audio' => $maleAudio,
            'female_audio' => $femaleAudio,
        ]) {
            $vocab = new Vocabulary;
            $vocab->kana = $kana;
            $vocab->level = $level;
            $vocab->wk_id = $wkId;
            $vocab->meaning = $meaning;
            $vocab->character = $character;
            $vocab->sentences = $sentences;
            $vocab->male_audio = $maleAudio;
            $vocab->female_audio = $femaleAudio;
            $vocab->save();
        }
    }
}
