<?php namespace App\Events\Stats;

use App\Events\Event;

class GigViewed extends Event
{
    public $table = 'gigs';

    public function __construct(public int $id)
    {
    }
}
