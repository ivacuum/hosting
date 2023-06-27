<?php

namespace App\Events\Stats;

use App\Events\Event;

class GalleryImagePreviewed extends Event
{
    public function __construct(public int $id)
    {
    }
}
