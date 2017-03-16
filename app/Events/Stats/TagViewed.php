<?php namespace App\Events\Stats;

use App\Events\Event;

class TagViewed extends Event
{
    public $id;
    public $table = 'tags';

    public function __construct($id)
    {
        $this->id = $id;
    }
}
