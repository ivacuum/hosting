<?php

namespace App\Domain\Telegram\Channel;

use App\Domain\Config;
use App\Domain\Telegram\Api\TelegramClient;

class TelegramAdminChannel
{
    public function __construct(private TelegramClient $telegram) {}

    public function send($notifiable, $notification): void
    {
        $adminId = Config::TelegramAdminId->get();

        if (!$adminId) {
            return;
        }

        $text = $notification->toTelegram($notifiable);

        $this->telegram
            ->chat($adminId)
            ->markdown()
            ->sendMessage($text);
    }
}
