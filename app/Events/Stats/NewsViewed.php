<?php namespace App\Events\Stats;

use App\Events\Event;

class NewsViewed extends Event
{
    public $id;
    public $table = 'news';

    public function __construct($id)
    {
        $this->id = $id;
    }
}
