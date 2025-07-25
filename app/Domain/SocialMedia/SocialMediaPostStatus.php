<?php

namespace App\Domain\SocialMedia;

enum SocialMediaPostStatus: int
{
    case Queued = 0;
    case Published = 1;
    case Excluded = 2;

    public function i18n(): string
    {
        return match ($this) {
            self::Queued => __('В очереди'),
            self::Published => __('Опубликован'),
            self::Excluded => __('Исключен'),
        };
    }

    public function isExcluded(): bool
    {
        return $this === self::Excluded;
    }

    public function isPublished(): bool
    {
        return $this === self::Published;
    }

    public function isQueued(): bool
    {
        return $this === self::Queued;
    }

    public static function labels(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->i18n()])
            ->all();
    }
}
