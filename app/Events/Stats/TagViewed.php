<?php namespace App\Events\Stats;

use App\Events\Event;

class TagViewed extends Event
{
    public $table = 'tags';

    public function __construct(public int $id)
    {
    }
}
