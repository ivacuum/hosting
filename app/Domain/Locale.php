<?php

namespace App\Domain;

enum Locale: string
{
    case Eng = 'en';
    case Rus = 'ru';

    public function isRussian(): bool
    {
        return $this === self::Rus;
    }
}
