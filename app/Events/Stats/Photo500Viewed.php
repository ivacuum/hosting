<?php

namespace App\Events\Stats;

class Photo500Viewed
{
    public function __construct(public string $slug)
    {
    }
}
