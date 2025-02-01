<?php

namespace App\Domain;

enum NotificationDeliveryMethod: int
{
    case Disabled = 0;
    case Mail = 1;
    case Telegram = 2;

    public function isDisabled(): bool
    {
        return $this === self::Disabled;
    }

    public function isEnabled(): bool
    {
        return $this === self::Mail;
    }

    public function isMail(): bool
    {
        return $this === self::Mail;
    }

    public function isTelegram(): bool
    {
        return $this === self::Telegram;
    }
}
