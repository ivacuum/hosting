<?php

namespace App\Events\Stats;

use App\Events\Event;

class TripViewed extends Event
{
    public $table = 'trips';

    public function __construct(public int $id)
    {
    }
}
