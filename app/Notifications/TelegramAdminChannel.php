<?php

namespace App\Notifications;

use Ivacuum\Generic\Services\Telegram;

class TelegramAdminChannel
{
    public function __construct(private Telegram $telegram)
    {
    }

    public function send($notifiable, $notification): void
    {
        $text = $notification->toTelegram($notifiable);

        $this->telegram->notifyAdmin($text);
    }
}
