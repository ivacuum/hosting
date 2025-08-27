<?php

namespace App\Events\Stats;

class GalleryImagePreviewed
{
    public function __construct(public int $id) {}
}
