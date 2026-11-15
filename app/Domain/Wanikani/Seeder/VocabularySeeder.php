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
            'male_audio' => '0tfsh0nioen77s9zvgikf8u2xx3k',
            'female_audio' => '9tcqe3x3e2k0awyugsvsrwi6gye8',
        ],
        [
            'kana' => 'いちがつ',
            'level' => 2,
            'wk_id' => 2544,
            'meaning' => 'january',
            'character' => '一月',
            'sentences' => '',
            'male_audio' => 'hd5a0vyq4j6h5k4xcr5nstge7xoy',
            'female_audio' => 'en7g0oe98g9trh07hyz5gmwh6g5u',
        ],
        [
            'kana' => 'にがつ',
            'level' => 2,
            'wk_id' => 2545,
            'meaning' => 'february',
            'character' => '二月',
            'sentences' => '',
            'male_audio' => 'pcti9ni90cawqt5f7mbjqe2g7uqw',
            'female_audio' => 'o2b4b8zfg7128ccjyzblbjvteuwp',
        ],
        [
            'kana' => 'ごがつ',
            'level' => 2,
            'wk_id' => 2522,
            'meaning' => 'may',
            'character' => '五月',
            'sentences' => '',
            'male_audio' => '29862e8pksqsf86j5y89u2zwl1c0',
            'female_audio' => 'i7wndrfgujmlnxqb9a3qxj9fk3wz',
        ],
        [
            'kana' => 'コーヒー',
            'level' => 3,
            'wk_id' => 9182,
            'meaning' => 'coffee',
            'character' => 'コーヒー',
            'sentences' => '',
            'male_audio' => '21xpeoy8fggo041105p5d59ul5k9',
            'female_audio' => 'n0aejqjq6yc077zhrem1malcc963',
        ],
        [
            'kana' => 'とき',
            'level' => 7,
            'wk_id' => 2958,
            'meaning' => 'time, hour',
            'character' => '時',
            'sentences' => '',
            'male_audio' => 'i4ec8u23rv02my266xwv7ulwv6x8',
            'female_audio' => 'an433fqj7yp6eh88z7dtp4707nfp',
        ],
    ];

    public function run(): void
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
