<?php

namespace App\Notifications;

use App\Magnet;
use Illuminate\Notifications\Notification;

class AnonymousMagnetNotification extends Notification
{
    public function __construct(private Magnet $magnet)
    {
    }

    public function toTelegram(): string
    {
        $url = url($this->magnet->www());
        $title = $this->magnet->title;

        return "🧲️ Раздача добавлена анонимно\n\n{$title}\n{$url}";
    }

    public function via(): array
    {
        return [TelegramAdminChannel::class];
    }
}
