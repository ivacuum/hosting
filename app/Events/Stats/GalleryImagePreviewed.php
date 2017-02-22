<?php namespace App\Events\Stats;

use App\Events\Event;

class GalleryImagePreviewed extends Event
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
