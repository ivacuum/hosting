<?php

namespace App\Domain;

enum Locale: string
{
    case Eng = 'en';
    case Rus = 'ru';

    public static function forNotification(string $uiLocale): self
    {
        return self::tryFrom($uiLocale)
            ?? self::tryFrom(Config::DefaultLocale->get())
            ?? self::Rus;
    }

    public function isRussian(): bool
    {
        return $this === self::Rus;
    }
}
