<?php namespace App\Domain;

enum CommentStatus: int
{
    case Hidden = 0;
    case Published = 1;
    case Pending = 2;

    public function i18n(): string
    {
        return match ($this) {
            self::Hidden => __('Скрыт'),
            self::Published => __('Опубликован'),
            self::Pending => __('Ожидает активации'),
        };
    }

    public function isHidden(): bool
    {
        return $this === self::Hidden;
    }

    public function isPending(): bool
    {
        return $this === self::Pending;
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
