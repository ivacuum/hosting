<?php namespace App\Listeners;

use App\Trip;

class TripPhotosSlugPrefixUpdate
{
    public function handle(Trip $trip)
    {
        if (!$trip->isDirty('slug')) {
            return;
        }

        foreach ($trip->photos as $photo) {
            /* @var \App\Photo $photo */
            $photo->newSlugPrefix($trip->slug);
            $photo->save();
        }
    }
}
