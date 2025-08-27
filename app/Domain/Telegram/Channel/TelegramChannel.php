<?php

namespace App\Domain\Telegram\Channel;

use App\Domain\Telegram\Api\TelegramClient;
use App\User;

class TelegramChannel
{
    public function __construct(private TelegramClient $telegram) {}

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
