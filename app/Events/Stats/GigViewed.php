<?php namespace App\Events\Stats;

use App\Events\Event;

class GigViewed extends Event
{
    public $id;
    public $table = 'gigs';

    public function __construct($id)
    {
        $this->id = $id;
    }
}
