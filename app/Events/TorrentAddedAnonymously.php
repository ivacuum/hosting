<?php namespace App\Events;

use App\Torrent;
use Illuminate\Queue\SerializesModels;

class TorrentAddedAnonymously extends Event
{
    use SerializesModels;

    public function __construct(public Torrent $model)
    {
    }
}
