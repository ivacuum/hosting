<?php namespace App\Events\Stats;

use App\Events\Event;

class TripViewed extends Event
{
    public $id;
    public $table = 'trips';

    public function __construct($id)
    {
        $this->id = $id;
    }
}
