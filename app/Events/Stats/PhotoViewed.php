<?php

namespace App\Events\Stats;

use App\Events\Event;

class PhotoViewed extends Event
{
    public $table = 'photos';

    public function __construct(public int $id)
    {
    }
}
