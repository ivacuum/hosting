<?php

namespace App\Domain\Japanese\Action;

class SpellOutJapaneseNumberAction
{
    private const array DIGITS = [
        '',
        'いち',
        'に',
        'さん',
        'よん',
        'ご',
        'ろく',
        'なな',
        'はち',
        'きゅう',
    ];

    private const array HUNDREDS = [
        '',
        'ひゃく',
        'にひゃく',
        'さんびゃく',
        'よんひゃく',
        'ごひゃく',
        'ろっぴゃく',
        'ななひゃく',
        'はっぴゃく',
        'きゅうひゃく',
    ];

    private const array THOUSANDS = [
        '',
        'せん',
        'にせん',
        'さんぜん',
        'よんせん',
        'ごせん',
        'ろくせん',
        'ななせん',
        'はっせん',
        'きゅうせん',
    ];

    public function execute(int $number): string
    {
        if ($number < -999_999_999_999 || $number > 999_999_999_999) {
            throw new \InvalidArgumentException(
                'Expected an integer between -999,999,999,999 and 999,999,999,999.'
            );
        }

        if ($number < 0) {
            return 'まいなす' . $this->execute(-$number);
        }

        if ($number === 0) {
            return 'ぜろ';
        }

        $result = '';

        foreach (['', 'まん', 'おく'] as $unit) {
            $group = $number % 10_000;
            $number = intdiv($number, 10_000);

            if ($group !== 0) {
                $result = $this->readGroup($group) . $unit . $result;
            }
        }

        return $result;
    }

    private function readGroup(int $number): string
    {
        $thousands = intdiv($number, 1000);
        $hundreds = intdiv($number, 100) % 10;
        $tens = intdiv($number, 10) % 10;
        $ones = $number % 10;

        $tensReading = match ($tens) {
            0 => '',
            1 => 'じゅう',
            default => self::DIGITS[$tens] . 'じゅう',
        };

        return self::THOUSANDS[$thousands]
            . self::HUNDREDS[$hundreds]
            . $tensReading
            . self::DIGITS[$ones];
    }
}
