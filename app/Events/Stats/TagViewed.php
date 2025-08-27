<?php

namespace App\Events\Stats;

class TagViewed
{
    public $table = 'tags';

    public function __construct(public int $id) {}
}
