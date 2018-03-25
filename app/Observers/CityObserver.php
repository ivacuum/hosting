<?php namespace App\Observers;

use App\City as Model;

class CityObserver
{
    public function deleted(Model $model)
    {
        \CacheHelper::forgetTrips();
    }

    public function saved(Model $model)
    {
        \CacheHelper::forgetTrips();
    }
}
