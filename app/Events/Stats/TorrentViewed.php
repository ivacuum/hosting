<?php

namespace App\Events\Stats;

class TorrentViewed
{
    public $table = 'magnets';

    public function __construct(public int $id) {}
}
