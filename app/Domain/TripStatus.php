<?php namespace App\Domain;

enum TripStatus: int
{
    case Inactive = 0;
    case Published = 1;
    case Hidden = 2;

    public function i18n(): string
    {
        return match ($this) {
            self::Inactive => __('Неактивна'),
            self::Published => __('Опубликована'),
            self::Hidden => __('Скрыта'),
        };
    }

    public function isHidden(): bool
    {
        return $this === self::Hidden;
    }

    public function isInactive(): bool
    {
        return $this === self::Inactive;
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
