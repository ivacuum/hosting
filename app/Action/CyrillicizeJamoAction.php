<?php namespace App\Action;

class CyrillicizeJamoAction
{
    public function execute(string $jamo): array
    {
        return match ($jamo) {
            'ㅂ' => ['п-', '-б-', '-п'],
            'ㅈ' => ['ч', '-дж-', '-т'],
            'ㄷ' => ['т-', '-д-', '-т'],
            'ㄱ' => ['к-', '-г-', '-к'],
            'ㅅ' => ['с', '-т'],
            'ㅁ' => ['м'],
            'ㄴ' => ['н'],
            'ㅇ' => ['-н'],
            'ㄹ' => ['-р-', '-ль'],
            'ㅎ' => ['х'],
            'ㅋ' => ['кх', '-к'],
            'ㅌ' => ['тх', '-т'],
            'ㅊ' => ['чх', '-т'],
            'ㅍ' => ['пх', '-п'],
            'ㅃ' => ['пп'],
            'ㅉ' => ['чч', 'дж'],
            'ㄸ' => ['тт'],
            'ㄲ' => ['кк'],
            'ㅆ' => ['сс', '-т'],

            'ㅛ',
            'ㅕ' => ['ё'],
            'ㅑ' => ['я'],
            'ㅐ' => ['э'],
            'ㅔ' => ['е'],
            'ㅗ',
            'ㅓ' => ['о'],
            'ㅏ' => ['а'],
            'ㅣ' => ['и'],
            'ㅠ' => ['ю'],
            'ㅜ' => ['у'],
            'ㅡ' => ['ы'],
            'ㅒ' => ['йа'],
            'ㅖ' => ['йе', '-е'],

            'ㅚ',
            'ㅞ' => ['ве'],
            'ㅟ' => ['ви'],
            'ㅝ' => ['во'],
            'ㅙ' => ['вэ'],
            'ㅢ' => ['ый', '-и', '-е'],
            'ㅘ' => ['ва'],
        };
    }
}