<?php namespace App\Action;

class HiraganizeJapaneseNumberAction
{
    public function execute(string $number): string
    {
        return strtr($number, [
            '兆' => 'ちょう',
            '億' => 'おく',
            '万' => 'まん',
            '千' => 'せん',
            '八百' => 'はっぴゃく',
            '六百' => 'ろっぴゃく',
            '三百' => 'さんびゃく',
            '百' => 'ひゃく',
            '十' => 'じゅう',
            '九' => 'きゅう',
            '八' => 'はち',
            '七' => 'なな',
            '六' => 'ろく',
            '五' => 'ご',
            '四' => 'よん',
            '三' => 'さん',
            '二' => 'に',
            '一' => 'いち',
            '〇' => 'ぜろ',
        ]);
    }
}
