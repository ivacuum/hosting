<?php namespace App\Notifications;

use App\Http\Controllers\Torrents;
use App\Torrent;
use App\User;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TorrentUpdatedNotification extends Notification
{
    public $torrent;

    public function __construct(Torrent $torrent)
    {
        $this->torrent = $torrent;
    }

    public function via(User $notifiable)
    {
        return $notifiable->telegram_id
            ? [TelegramChannel::class]
            : ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->torrent->id,
            'title' => $this->torrent->title,
            'info_hash' => $this->torrent->info_hash,
            'announcer' => $this->torrent->announcer,
        ];
    }

    public function toTelegram(User $notifiable)
    {
        $url = action([Torrents::class, 'show'], $this->torrent->id);

        return TelegramMessage::create()
            ->to($notifiable->telegram_id)
            ->content("Обновлена раздача *{$this->torrent->title}*\n\n{$url}");
    }
}
