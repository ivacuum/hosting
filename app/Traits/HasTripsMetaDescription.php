<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;

trait HasTripsMetaDescription
{
    public function metaDescription(Collection $trips): string
    {
        /** @var Collection|\App\Trip[] $trips */
        if (!$totalTrips = $trips->flatten()->count()) {
            return '';
        }

        $tripsNext = \ViewHelper::plural('trips', $totalTrips);
        $totalPhotos = $trips->flatten()->sum->photos_count;

        if (!$totalPhotos) {
            return $tripsNext;
        }

        $photosText = \ViewHelper::plural('photos', $totalPhotos);

        return "{$tripsNext} · {$photosText}";
    }
}
