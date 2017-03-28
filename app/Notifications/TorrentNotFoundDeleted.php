<?php namespace App\Notifications;

use App\Torrent;
use Illuminate\Notifications\Notification;

class TorrentNotFoundDeleted extends Notification
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
            'rto_id' => $this->torrent->rto_id,
        ];
    }
}
