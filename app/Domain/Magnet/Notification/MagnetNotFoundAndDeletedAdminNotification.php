<?php

namespace App\Domain\Magnet\Notification;

use App\Domain\Magnet\Models\Magnet;
use App\Domain\Telegram\Action\EscapeMarkdownCharactersAction;
use App\Domain\Telegram\Channel\TelegramAdminChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class MagnetNotFoundAndDeletedAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Magnet $magnet) {}

    public function toTelegram(): string
    {
        $escape = app(EscapeMarkdownCharactersAction::class);

        $url = $escape->execute(url($this->magnet->wwwAcp()));
        $title = $escape->execute($this->magnet->title);
        $externalUrl = $escape->execute($this->magnet->externalLink());

        return "🧲️ Раздача не найдена и удалена\n\n{$title}\n{$externalUrl}\n\n{$url}";
    }

    public function via(): array
    {
        return [TelegramAdminChannel::class];
    }
}
