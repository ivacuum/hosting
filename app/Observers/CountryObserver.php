<?php namespace App\Observers;

use App\Country as Model;

class CountryObserver
{
    public function deleted(Model $model)
    {
        \CacheHelper::forgetCities();
        \CacheHelper::forgetCountries();
        \CacheHelper::forgetTrips();
    }

    public function saved(Model $model)
    {
        \CacheHelper::forgetCities();
        \CacheHelper::forgetCountries();
        \CacheHelper::forgetTrips();
    }
}
