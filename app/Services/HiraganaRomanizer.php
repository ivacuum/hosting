<?php

namespace App\Services;

class HiraganaRomanizer
{
    public const DICTIONARY = [
        'あ' => 'a',
        'か' => 'ka',
        'さ' => 'sa',
        'た' => 'ta',
        'な' => 'na',
        'は' => 'ha',
        'ま' => 'ma',
        'や' => 'ya',
        'ら' => 'ra',
        'わ' => 'wa',
        'ん' => 'n',
        'が' => 'ga',
        'ざ' => 'za',
        'だ' => 'da',
        'ば' => 'ba',
        'ぱ' => 'pa',

        'い' => 'i',
        'き' => 'ki',
        'し' => 'shi',
        'ち' => 'chi',
        'に' => 'ni',
        'ひ' => 'hi',
        'み' => 'mi',
        'り' => 'ri',
        'ぎ' => 'gi',
        'じ' => 'ji',
        'ぢ' => 'ji',
        'び' => 'bi',
        'ぴ' => 'pi',

        'う' => 'u',
        'く' => 'ku',
        'す' => 'su',
        'つ' => 'tsu',
        'ぬ' => 'nu',
        'ふ' => 'fu',
        'む' => 'mu',
        'ゆ' => 'yu',
        'る' => 'ru',
        'ぐ' => 'gu',
        'ず' => 'zu',
        'づ' => 'zu',
        'ぶ' => 'bu',
        'ぷ' => 'pu',

        'え' => 'e',
        'け' => 'ke',
        'せ' => 'se',
        'て' => 'te',
        'ね' => 'ne',
        'へ' => 'he',
        'め' => 'me',
        'れ' => 're',
        'げ' => 'ge',
        'ぜ' => 'ze',
        'で' => 'de',
        'べ' => 'be',
        'ぺ' => 'pe',

        'お' => 'o',
        'こ' => 'ko',
        'そ' => 'so',
        'と' => 'to',
        'の' => 'no',
        'ほ' => 'ho',
        'も' => 'mo',
        'よ' => 'yo',
        'ろ' => 'ro',
        'を' => 'wo',
        'ご' => 'go',
        'ぞ' => 'zo',
        'ど' => 'do',
        'ぼ' => 'bo',
        'ぽ' => 'po',

        'きゃ' => 'kya',
        'きゅ' => 'kyu',
        'きょ' => 'kyo',

        'しゃ' => 'sha',
        'しゅ' => 'shu',
        'しょ' => 'sho',

        'ちゃ' => 'cha',
        'ちゅ' => 'chu',
        'ちょ' => 'cho',

        'にゃ' => 'nya',
        'にゅ' => 'nyu',
        'にょ' => 'nyo',

        'ひゃ' => 'hya',
        'ひゅ' => 'hyu',
        'ひょ' => 'hyo',

        'みゃ' => 'mya',
        'みゅ' => 'myu',
        'みょ' => 'myo',

        'ぎゃ' => 'gya',
        'ぎゅ' => 'gyu',
        'ぎょ' => 'gyo',

        'ぢゃ' => 'ja', // dya
        'ぢゅ' => 'ju', // dyu
        'ぢょ' => 'jo', // dyo

        'じゃ' => 'ja',
        'じゅ' => 'ju',
        'じょ' => 'jo',

        'びゃ' => 'bya',
        'びゅ' => 'byu',
        'びょ' => 'byo',

        'ぴゃ' => 'pya',
        'ぴゅ' => 'pyu',
        'ぴょ' => 'pyo',

        'りゃ' => 'rya',
        'りゅ' => 'ryu',
        'りょ' => 'ryo',

        'ファ' => 'fa',

        'ぁ' => 'a',
        'ぃ' => 'i',
        'ぅ' => 'u',
        'ぇ' => 'e',
        'ぉ' => 'o',
        'っ' => 't', // xtsu
    ];

    public function romanize(string $hiragana): string
    {
        $length = mb_strlen($hiragana);
        $result = '';

        foreach (range(1, $length) as $i) {
            $kana = mb_substr($hiragana, $i - 1, 1);
            $romaji = self::DICTIONARY[$kana] ?? '';
            $nextKana = '';

            if (!$romaji) {
                continue;
            }

            if ($i < $length) {
                $nextKana = mb_substr($hiragana, $i, 1);
            }

            if ($kana === 'っ') {
                if ($nextKana && $nextRomaji = self::DICTIONARY[$nextKana] ?? '') {
                    $result .= mb_substr($nextRomaji, 0, 1);

                    continue;
                }

                throw new \Exception("Next kana: {$nextKana}");
            } elseif (in_array($nextKana, ['ゃ', 'ょ', 'ゅ'])) {
                if ($nextRomaji = self::DICTIONARY[$kana . $nextKana] ?? '') {
                    $result .= $nextRomaji;

                    continue;
                }

                throw new \Exception("Combination: {$kana}{$nextKana}");
            }

            $result .= $romaji;
        }

        return $result;
    }
}
