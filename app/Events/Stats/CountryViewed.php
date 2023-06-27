<?php

namespace App\Events\Stats;

use App\Events\Event;

class CountryViewed extends Event
{
    public $table = 'countries';

    public function __construct(public int $id)
    {
    }
}
