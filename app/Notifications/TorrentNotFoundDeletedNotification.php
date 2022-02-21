<?php namespace App\Notifications;

use App\Magnet;
use Illuminate\Notifications\Notification;

class TorrentNotFoundDeletedNotification extends Notification
{
    public function __construct(public Magnet $magnet)
    {
    }

    public function via()
    {
        return ['database'];
    }

    public function toArray()
    {
        return [
            'id' => $this->magnet->id,
            'title' => $this->magnet->title,
            'rto_id' => $this->magnet->rto_id,
        ];
    }
}
