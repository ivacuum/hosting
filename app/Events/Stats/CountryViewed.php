<?php namespace App\Events\Stats;

use App\Events\Event;

class CountryViewed extends Event
{
    public $id;
    public $table = 'countries';

    public function __construct($id)
    {
        $this->id = $id;
    }
}
