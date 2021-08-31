<?php namespace App\Notifications;

use App\Torrent;
use Illuminate\Notifications\Notification;

class TorrentNotFoundDeletedNotification extends Notification
{
    public function __construct(public Torrent $torrent)
    {
    }

    public function via()
    {
        return ['database'];
    }

    public function toArray()
    {
        return [
            'id' => $this->torrent->id,
            'title' => $this->torrent->title,
            'rto_id' => $this->torrent->rto_id,
        ];
    }
}
