<?php namespace App\Events\Stats;

class Photo1000Viewed
{
    public function __construct(public string $slug)
    {
    }
}
