<?php

namespace App\Events\Stats;

class NewsViewed
{
    public $table = 'news';

    public function __construct(public int $id) {}
}
