<?php namespace App\Events\Stats;

use App\Events\Event;

class PhotoViewed extends Event
{
    public $id;
    public $table = 'photos';

    public function __construct($id)
    {
        $this->id = $id;
    }
}
