<?php namespace App\Events;

use App\Magnet;
use Illuminate\Queue\SerializesModels;

class TorrentAddedAnonymously extends Event
{
    use SerializesModels;

    public function __construct(public Magnet $model)
    {
    }
}
