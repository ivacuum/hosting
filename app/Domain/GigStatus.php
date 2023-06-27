<?php

namespace App\Domain;

enum GigStatus: int
{
    case Hidden = 0;
    case Published = 1;

    public function i18n(): string
    {
        return match ($this) {
            self::Hidden => __('Скрыт'),
            self::Published => __('Опубликован'),
        };
    }

    public function isHidden(): bool
    {
        return $this === self::Hidden;
    }

    public function isPublished(): bool
    {
        return $this === self::Published;
    }

    public static function labels(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->i18n()])
            ->all();
    }
}
