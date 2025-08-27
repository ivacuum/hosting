<?php

namespace App\Events\Stats;

class PhotoViewed
{
    public $table = 'photos';

    public function __construct(public int $id) {}
}
