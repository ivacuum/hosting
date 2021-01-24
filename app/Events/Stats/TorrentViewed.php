<?php namespace App\Events\Stats;

use App\Events\Event;

class TorrentViewed extends Event
{
    public $table = 'torrents';

    public function __construct(public int $id)
    {
    }
}
