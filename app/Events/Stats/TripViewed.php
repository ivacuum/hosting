<?php

namespace App\Events\Stats;

class TripViewed
{
    public $table = 'trips';

    public function __construct(public int $id) {}
}
