<?php

namespace App\Events\Stats;

class CountryViewed
{
    public $table = 'countries';

    public function __construct(public int $id) {}
}
