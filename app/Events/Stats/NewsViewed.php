<?php

namespace App\Events\Stats;

use App\Events\Event;

class NewsViewed extends Event
{
    public $table = 'news';

    public function __construct(public int $id)
    {
    }
}
