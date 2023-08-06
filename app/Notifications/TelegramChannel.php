<?php

namespace App\Notifications;

use App\User;
use Ivacuum\Generic\Telegram\TelegramClient;

class TelegramChannel
{
    public function __construct(private TelegramClient $telegram)
    {
    }

    public function send(User $notifiable, $notification): void
    {
        if (!$notifiable->telegram_id) {
            return;
        }

        $text = $notification->toTelegram($notifiable);

        $this->telegram
            ->chat($notifiable->telegram_id)
            ->markdown()
            ->sendMessage($text);
    }
}
