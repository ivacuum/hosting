<?php

namespace App\Notifications;

use App\Magnet;
use Illuminate\Notifications\Notification;

class MagnetNotFoundAndDeletedAdminNotification extends Notification
{
    public function __construct(public Magnet $magnet) {}

    public function toTelegram()
    {
        $url = url($this->magnet->wwwAcp());
        $title = $this->magnet->title;
        $externalUrl = $this->magnet->externalLink();

        return "🧲️ Раздача не найдена и удалена\n\n{$title}\n{$externalUrl}\n\n{$url}";
    }

    public function via()
    {
        return [TelegramAdminChannel::class];
    }
}
