<?php namespace App\Listeners;

use App\Photo;
use App\Trip;

/**
 * Публикация фотографий вслед за публикацией поездки (и наоборот)
 */
class ToggleTripPhotosStatus
{
    public function handle(Trip $trip)
    {
        if (!$trip->isDirty('status')) {
            return;
        }

        $status = $trip->status === Trip::STATUS_PUBLISHED ? Photo::STATUS_PUBLISHED : Photo::STATUS_HIDDEN;

        foreach ($trip->photos as $photo) {
            /* @var \App\Photo $photo */
            $photo->status = $status;
            $photo->save();
        }
    }
}
