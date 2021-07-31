<?php namespace App\Domain;

class DcppHubStatus implements \JsonSerializable
{
    const HIDDEN = 0;
    const PUBLISHED = 1;
    const DELETED = 2;

    public function __construct(private int $status)
    {
    }

    public static function cases(): array
    {
        return [
            self::HIDDEN => (new self(self::HIDDEN))->i18n(),
            self::PUBLISHED => (new self(self::PUBLISHED))->i18n(),
            self::DELETED => (new self(self::DELETED))->i18n(),
        ];
    }

    public function i18n()
    {
        return match ($this->status) {
            self::HIDDEN => __('Скрыт'),
            self::PUBLISHED => __('Опубликован'),
            self::DELETED => __('Удален'),
        };
    }

    public function isHidden(): bool
    {
        return $this->status === self::HIDDEN;
    }

    public function jsonSerialize()
    {
        return $this->status;
    }
}
