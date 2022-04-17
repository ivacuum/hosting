<?php namespace App\Domain;

enum MagnetStatus: int
{
    case Hidden = 0;
    case Published = 1;
    case Deleted = 2;

    public function i18n(): string
    {
        return match ($this) {
            self::Hidden => __('Скрыт'),
            self::Published => __('Опубликован'),
            self::Deleted => __('Удален'),
        };
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
