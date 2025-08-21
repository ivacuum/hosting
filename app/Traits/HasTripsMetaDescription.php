<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;

trait HasTripsMetaDescription
{
    public function metaDescription(Collection $trips): string
    {
        /** @var Collection|\App\Domain\Life\Models\Trip[] $trips */
        if (!$totalTrips = $trips->flatten()->count()) {
            return '';
        }

        $tripsText = \ViewHelper::plural('visits', $totalTrips);
        $totalPhotos = $trips->flatten()->sum->photos_count;

        if (!$totalPhotos) {
            return $tripsText;
        }

        $photosText = \ViewHelper::plural('photos', $totalPhotos);

        return "{$tripsText} · {$photosText}";
    }
}
