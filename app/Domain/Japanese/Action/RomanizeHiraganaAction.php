<?php

namespace App\Domain\Japanese\Action;

class RomanizeHiraganaAction
{
    private const array DICTIONARY = [
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
        'ぢ' => 'di',
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
        'づ' => 'du',
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

        'ふぁ' => 'fa',
        'ふぃ' => 'fi',
        'ふぇ' => 'fe',
        'ふぉ' => 'fo',
        'てぃ' => 'ti',
        'でぃ' => 'di',
        'ちぇ' => 'che',
        'しぇ' => 'she',
        'じぇ' => 'je',
        'うぃ' => 'wi',
        'うぇ' => 'we',

        'ぁ' => 'a',
        'ぃ' => 'i',
        'ぅ' => 'u',
        'ぇ' => 'e',
        'ぉ' => 'o',
    ];

    public function execute(string $kana): string
    {
        $characters = mb_str_split(mb_convert_kana($kana, 'c'));
        $result = '';

        for ($i = 0, $count = count($characters); $i < $count; $i++) {
            $current = $characters[$i];
            $next = $characters[$i + 1] ?? '';

            if ($current === 'っ') {
                $nextRomaji = self::DICTIONARY[$next] ?? throw new \InvalidArgumentException("Next kana: {$next}");
                $result .= str_starts_with($nextRomaji, 'ch') ? 't' : $nextRomaji[0];

                continue;
            }

            if ($current === 'ー') {
                $vowel = substr($result, -1);

                if (!in_array($vowel, ['a', 'i', 'u', 'e', 'o'], true)) {
                    throw new \InvalidArgumentException("No vowel to prolong: {$kana}");
                }

                $result .= $vowel;

                continue;
            }

            if (isset(self::DICTIONARY[$current . $next])) {
                $result .= self::DICTIONARY[$current . $next];
                $i++;

                continue;
            }

            $result .= self::DICTIONARY[$current] ?? throw new \InvalidArgumentException("Unknown kana: {$current}");
        }

        return $result;
    }
}
