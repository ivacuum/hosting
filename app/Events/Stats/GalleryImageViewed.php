<?php namespace App\Events\Stats;

use App\Events\Event;

class GalleryImageViewed extends Event
{
    public function __construct(public string $dateAndSlug)
    {
    }

    public static function fromArray(array $payload)
    {
        return new self($payload['dateAndSlug']);
    }
}
