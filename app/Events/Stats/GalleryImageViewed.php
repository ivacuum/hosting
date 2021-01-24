<?php namespace App\Events\Stats;

use App\Events\Event;

class GalleryImageViewed extends Event
{
    public function __construct(public int $id)
    {
    }
}
