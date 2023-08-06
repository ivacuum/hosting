<?php

namespace App\Notifications;

use App\Magnet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class MagnetDuplicateDeletedAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Magnet $magnet)
    {
    }

    public function toTelegram()
    {
        $url = url($this->magnet->wwwAcp());
        $title = $this->magnet->title;
        $externalUrl = $this->magnet->externalLink();

        return "🧲️ Раздача закрыта как повторная и удалена\n\n{$title}\n{$externalUrl()}\n\n{$url}";
    }

    public function via()
    {
        return [TelegramAdminChannel::class];
    }
}
