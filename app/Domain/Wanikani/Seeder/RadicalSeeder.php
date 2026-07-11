<?php

namespace App\Domain\Wanikani\Seeder;

use App\Domain\Wanikani\Models\Radical;
use Illuminate\Database\Seeder;

class RadicalSeeder extends Seeder
{
    private const array RADICALS = [
        [
            'level' => 1,
            'wk_id' => 1,
            'meaning' => 'ground',
            'character' => '一',
        ],
        [
            'level' => 1,
            'wk_id' => 2,
            'meaning' => 'fins',
            'character' => 'ハ',
        ],
        [
            'level' => 1,
            'wk_id' => 3,
            'meaning' => 'drop',
            'character' => '丶',
        ],
        [
            'level' => 1,
            'wk_id' => 8762,
            'meaning' => 'gun',
            'character' => '𠂉',
        ],
        [
            'level' => 2,
            'wk_id' => 43,
            'meaning' => 'moon',
            'character' => '月',
        ],
        [
            'level' => 2,
            'wk_id' => 51,
            'meaning' => 'rice paddy',
            'character' => '田',
        ],
        [
            'level' => 5,
            'wk_id' => 8770,
            'meaning' => 'kick',
            'character' => '',
        ],
    ];

    public function run()
    {
        foreach (self::RADICALS as [
            'level' => $level,
            'wk_id' => $wkId,
            'meaning' => $meaning,
            'character' => $character,
        ]) {
            $radical = new Radical;
            $radical->level = $level;
            $radical->wk_id = $wkId;
            $radical->meaning = $meaning;
            $radical->character = $character;
            $radical->save();
        }
    }
}
