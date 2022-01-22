<?php namespace App\Observers;

use App\Domain\PhotoStatus;
use App\Trip as Model;
use App\Utilities\CacheHelper;

class TripObserver
{
    public function __construct(private CacheHelper $cache)
    {
    }

    public function deleting(Model $model)
    {
        \DB::transaction(function () use ($model) {
            $model->comments->each->delete();
        });
    }

    public function deleted()
    {
        $this->cache->forgetTrips();
    }

    public function saved(Model $model)
    {
        $this->toggleTripPhotosStatus($model);

        $this->cache->forgetTrips();
    }

    public function updated(Model $model)
    {
        $this->updateTripPhotosSlugPrefix($model);
    }

    // Публикация фотографий вслед за публикацией поездки (и наоборот)
    protected function toggleTripPhotosStatus(Model $model)
    {
        if (!$model->isDirty('status')) {
            return;
        }

        $status = $model->status->isPublished()
            ? PhotoStatus::Published
            : PhotoStatus::Hidden;

        foreach ($model->photos as $photo) {
            $photo->status = $status;
            $photo->save();
        }
    }

    protected function updateTripPhotosSlugPrefix(Model $model)
    {
        if (!$model->isDirty('slug')) {
            return;
        }

        foreach ($model->photos as $photo) {
            $photo->newSlugPrefix($model->slug);
            $photo->save();
        }
    }
}
