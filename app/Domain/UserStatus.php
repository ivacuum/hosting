<?php

namespace App\Domain;

enum UserStatus: int
{
    case Inactive = 0;
    case Active = 1;

    public function i18n(): string
    {
        return match ($this) {
            self::Inactive => __('Не активирован'),
            self::Active => __('Активирован'),
        };
    }

    public static function labels(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->i18n()])
            ->all();
    }
}
