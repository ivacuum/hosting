<?php

namespace App\Events\Stats;

class GalleryImageViewed
{
    public function __construct(public string $dateAndSlug) {}

    public static function fromArray(array $payload)
    {
        return new self($payload['dateAndSlug']);
    }
}
