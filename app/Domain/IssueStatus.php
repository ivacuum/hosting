<?php namespace App\Domain;

enum IssueStatus: int
{
    case Pending = 0;
    case Open = 1;
    case Closed = 2;

    public function i18n(): string
    {
        return match ($this) {
            self::Pending => __('Ожидает'),
            self::Open => __('Открыто'),
            self::Closed => __('Закрыто'),
        };
    }
}
