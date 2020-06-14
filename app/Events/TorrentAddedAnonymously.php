<?php namespace App\Events;

use App\Torrent;
use Illuminate\Queue\SerializesModels;

class TorrentAddedAnonymously extends Event
{
    use SerializesModels;

    public Torrent $model;

    public function __construct(Torrent $model)
    {
        $this->model = $model;
    }
}
