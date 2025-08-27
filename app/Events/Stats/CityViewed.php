<?php

namespace App\Events\Stats;

class CityViewed
{
    public $table = 'cities';

    public function __construct(public int $id) {}
}
