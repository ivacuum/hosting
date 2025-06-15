<?php

namespace App\Notifications;

use App\Domain\Telegram\Action\EscapeMarkdownCharactersAction;
use App\Magnet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class AnonymousMagnetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private Magnet $magnet) {}

    public function toTelegram(): string
    {
        $escape = app(EscapeMarkdownCharactersAction::class);

        $url = $escape->execute(url($this->magnet->www()));
        $title = $escape->execute($this->magnet->title);

        return "🧲️ Раздача добавлена анонимно\n\n{$title}\n{$url}";
    }

    public function via(): array
    {
        return [TelegramAdminChannel::class];
    }
}
