<?php namespace App\Domain;

class TripStatus implements \JsonSerializable
{
    const INACTIVE = 0;
    const PUBLISHED = 1;
    const HIDDEN = 2;

    public function __construct(private int $status)
    {
    }

    public static function cases(): array
    {
        return [
            self::INACTIVE => (new self(self::INACTIVE))->i18n(),
            self::PUBLISHED => (new self(self::PUBLISHED))->i18n(),
            self::HIDDEN => (new self(self::HIDDEN))->i18n(),
        ];
    }

    public function i18n()
    {
        return match ($this->status) {
            self::INACTIVE => __('Неактивна'),
            self::PUBLISHED => __('Опубликована'),
            self::HIDDEN => __('Скрыта'),
        };
    }

    public function isHidden(): bool
    {
        return $this->status === self::HIDDEN;
    }

    public function isInactive(): bool
    {
        return $this->status === self::INACTIVE;
    }

    public function isPublished(): bool
    {
        return $this->status === self::PUBLISHED;
    }

    public function jsonSerialize()
    {
        return $this->status;
    }

    public function __toString(): string
    {
        return $this->status;
    }
}
