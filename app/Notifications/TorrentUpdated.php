<?php namespace App\Notifications;

use App\Torrent;
use Illuminate\Notifications\Notification;

class TorrentUpdated extends Notification
{
    public $torrent;

    public function __construct(Torrent $torrent)
    {
        $this->torrent = $torrent;
    }

    public function via($notifiable)
    {
        return ['database'];
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
}
