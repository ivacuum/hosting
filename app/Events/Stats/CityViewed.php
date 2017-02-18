<?php namespace App\Events\Stats;

use App\Events\Event;

class CityViewed extends Event
{
    public $id;
    public $table = 'cities';

    public function __construct($id)
    {
        $this->id = $id;
    }
}
