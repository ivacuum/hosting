<?php namespace App\Seeder;

use App\Factory\VocabularyFactory;
use Illuminate\Database\Seeder;

class VocabularySeeder extends Seeder
{
    private const VOCABULARY = [
        [
            'kana' => 'ひとつ',
            'level' => 1,
            'wk_id' => 2468,
            'meaning' => 'one thing',
            'character' => '一つ',
            'sentences' => '',
            'male_audio_id' => 3050,
            'female_audio_id' => 27965,
        ], [
            'kana' => 'いちがつ',
            'level' => 2,
            'wk_id' => 2544,
            'meaning' => 'january',
            'character' => '一月',
            'sentences' => '',
            'male_audio_id' => 20849,
            'female_audio_id' => 30547,
        ], [
            'kana' => 'にがつ',
            'level' => 2,
            'wk_id' => 2545,
            'meaning' => 'february',
            'character' => '二月',
            'sentences' => '',
            'male_audio_id' => 21495,
            'female_audio_id' => 30524,
        ], [
            'kana' => 'ごがつ',
            'level' => 2,
            'wk_id' => 2522,
            'meaning' => 'may',
            'character' => '五月',
            'sentences' => '',
            'male_audio_id' => 20718,
            'female_audio_id' => 30475,
        ], [
            'kana' => 'とき',
            'level' => 7,
            'wk_id' => 2958,
            'meaning' => 'time, hour',
            'character' => '時',
            'sentences' => '',
            'male_audio_id' => 19983,
            'female_audio_id' => 39880,
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
            $vocab->male_audio_id = $data['male_audio_id'];
            $vocab->female_audio_id = $data['female_audio_id'];
            $vocab->save();
        }
    }
}
