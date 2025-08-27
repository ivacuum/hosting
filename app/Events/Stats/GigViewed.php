<?php

namespace App\Events\Stats;

class GigViewed
{
    public $table = 'gigs';

    public function __construct(public int $id) {}
}
