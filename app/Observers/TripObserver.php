<?php namespace App\Observers;

use App\Photo;
use App\Trip as Model;

class TripObserver
{
    public function deleting(Model $model)
    {
        \DB::transaction(function () use ($model) {
            $model->comments->each->delete();
        });
    }

    public function deleted(Model $model)
    {
        \CacheHelper::forgetTrips();
    }

    public function saved(Model $model)
    {
        $this->toggleTripPhotosStatus($model);

        \CacheHelper::forgetTrips();
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

        $status = $model->status === Model::STATUS_PUBLISHED
            ? Photo::STATUS_PUBLISHED
            : Photo::STATUS_HIDDEN;

        foreach ($model->photos as $photo) {
            /* @var Photo $photo */
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
            /* @var Photo $photo */
            $photo->newSlugPrefix($model->slug);
            $photo->save();
        }
    }
}
