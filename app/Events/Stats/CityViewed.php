<?php

namespace App\Events\Stats;

use App\Events\Event;

class CityViewed extends Event
{
    public $table = 'cities';

    public function __construct(public int $id)
    {
    }
}
