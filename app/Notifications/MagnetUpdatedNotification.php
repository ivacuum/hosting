<?php

namespace App\Notifications;

use App\Domain\Telegram\Action\EscapeMarkdownCharactersAction;
use App\Magnet;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class MagnetUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Magnet $magnet) {}

    public function toTelegram()
    {
        $escape = app(EscapeMarkdownCharactersAction::class);

        $url = $escape->execute(url($this->magnet->www()));
        $title = $escape->execute($this->magnet->title);

        return "Обновлена раздача *{$title}*\n\n{$url}";
    }

    public function via(User $notifiable)
    {
        return $notifiable->telegram_id
            ? [TelegramChannel::class]
            : [];
    }
}
