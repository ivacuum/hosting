<?php namespace App\Notifications;

use App\Http\Controllers\MagnetsController;
use App\Magnet;
use App\User;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class TorrentUpdatedNotification extends Notification
{
    public function __construct(public Magnet $magnet)
    {
    }

    public function via(User $notifiable)
    {
        return $notifiable->telegram_id
            ? ['telegram']
            : ['database'];
    }

    public function toArray()
    {
        return [
            'id' => $this->magnet->id,
            'title' => $this->magnet->title,
            'info_hash' => $this->magnet->info_hash,
            'announcer' => $this->magnet->announcer,
        ];
    }

    public function toTelegram(User $notifiable)
    {
        $url = action([MagnetsController::class, 'show'], $this->magnet->id);

        return TelegramMessage::create()
            ->to($notifiable->telegram_id)
            ->content("Обновлена раздача *{$this->magnet->title}*\n\n{$url}");
    }
}
