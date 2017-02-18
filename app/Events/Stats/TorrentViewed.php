<?php namespace App\Events\Stats;

use App\Events\Event;

class TorrentViewed extends Event
{
    public $id;
    public $table = 'torrents';

    public function __construct($id)
    {
        $this->id = $id;
    }
}
