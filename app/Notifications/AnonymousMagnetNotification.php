<?php

namespace App\Notifications;

use App\Magnet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class AnonymousMagnetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private Magnet $magnet)
    {
    }

    public function toTelegram(): string
    {
        $www = url($this->magnet->www());
        $title = $this->magnet->title;

        return "🧲️ Раздача добавлена анонимно\n\n{$title}\n{$www}";
    }

    public function via(): array
    {
        return [TelegramAdminChannel::class];
    }
}
