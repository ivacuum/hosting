<?php

namespace App\Notifications;

use App\Magnet;
use Illuminate\Notifications\Notification;

class MagnetDuplicateDeletedAdminNotification extends Notification
{
    public function __construct(public Magnet $magnet)
    {
    }

    public function toTelegram()
    {
        $url = url($this->magnet->wwwAcp());
        $title = $this->magnet->title;
        $externalUrl = $this->magnet->externalLink();

        return "🧲️ Раздача закрыта как повторная и удалена\n\n{$title}\n{$externalUrl}\n\n{$url}";
    }

    public function via()
    {
        return [TelegramAdminChannel::class];
    }
}
