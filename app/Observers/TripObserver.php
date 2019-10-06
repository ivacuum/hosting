<?php namespace App\Observers;

use App\Photo;
use App\Trip as Model;
use App\Utilities\CacheHelper;

class TripObserver
{
    private $cache;

    public function __construct(CacheHelper $cache)
    {
        $this->cache = $cache;
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

        $status = $model->status === Model::STATUS_PUBLISHED
            ? Photo::STATUS_PUBLISHED
            : Photo::STATUS_HIDDEN;

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
