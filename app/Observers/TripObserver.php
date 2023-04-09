<?php namespace App\Observers;

use App\Domain\PhotoStatus;
use App\Trip;
use App\Utilities\CacheHelper;

class TripObserver
{
    public function __construct(private CacheHelper $cache)
    {
    }

    public function deleting(Trip $trip)
    {
        \DB::transaction(function () use ($trip) {
            $trip->comments->each->delete();
        });
    }

    public function deleted()
    {
        $this->cache->forgetTrips();
    }

    public function saved(Trip $trip)
    {
        $this->toggleTripPhotosStatus($trip);

        $this->cache->forgetTrips();
    }

    public function updated(Trip $trip)
    {
        $this->updateTripPhotosSlugPrefix($trip);
    }

    // Публикация фотографий вслед за публикацией поездки (и наоборот)
    protected function toggleTripPhotosStatus(Trip $trip)
    {
        if (!$trip->isDirty('status')) {
            return;
        }

        $status = $trip->status->isPublished()
            ? PhotoStatus::Published
            : PhotoStatus::Hidden;

        foreach ($trip->photos as $photo) {
            $photo->status = $status;
            $photo->save();
        }
    }

    protected function updateTripPhotosSlugPrefix(Trip $trip)
    {
        if (!$trip->isDirty('slug')) {
            return;
        }

        foreach ($trip->photos as $photo) {
            $photo->newSlugPrefix($trip->slug);
            $photo->save();
        }
    }
}
