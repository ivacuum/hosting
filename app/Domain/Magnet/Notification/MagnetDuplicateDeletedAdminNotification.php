<?php

namespace App\Domain\Magnet\Notification;

use App\Domain\Magnet\Models\Magnet;
use App\Domain\Telegram\Action\EscapeMarkdownCharactersAction;
use App\Domain\Telegram\Channel\TelegramAdminChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class MagnetDuplicateDeletedAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Magnet $magnet) {}

    public function toTelegram()
    {
        $escape = app(EscapeMarkdownCharactersAction::class);

        $url = $escape->execute(url($this->magnet->wwwAcp()));
        $title = $escape->execute($this->magnet->title);
        $externalUrl = $escape->execute($this->magnet->externalLink());

        return "🧲️ Раздача закрыта как повторная и удалена\n\n{$title}\n{$externalUrl}\n\n{$url}";
    }

    public function via()
    {
        return [TelegramAdminChannel::class];
    }
}
