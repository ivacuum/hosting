<?php

namespace App\Notifications;

use App\Domain\Telegram\Action\EscapeMarkdownCharactersAction;
use App\Magnet;
use Illuminate\Notifications\Notification;

class MagnetNotFoundAndDeletedAdminNotification extends Notification
{
    public function __construct(public Magnet $magnet) {}

    public function toTelegram()
    {
        $escape = app(EscapeMarkdownCharactersAction::class);

        $url = $escape->execute(url($this->magnet->wwwAcp()));
        $title = $escape->execute($this->magnet->title);
        $externalUrl = $escape->execute($this->magnet->externalLink());

        return "🧲️ Раздача не найдена и удалена\n\n{$title}\n{$externalUrl}\n\n{$url}";
    }

    public function via()
    {
        return [TelegramAdminChannel::class];
    }
}
