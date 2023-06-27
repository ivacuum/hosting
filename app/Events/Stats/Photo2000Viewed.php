<?php

namespace App\Events\Stats;

class Photo2000Viewed
{
    public function __construct(public string $slug)
    {
    }
}
