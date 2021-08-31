<?php namespace App\Observers;

use App\Utilities\CacheHelper;

class CountryObserver
{
    public function __construct(private CacheHelper $cache)
    {
    }

    public function deleted()
    {
        $this->cache->forgetCities();
        $this->cache->forgetCountries();
        $this->cache->forgetTrips();
    }

    public function saved()
    {
        $this->cache->forgetCities();
        $this->cache->forgetCountries();
        $this->cache->forgetTrips();
    }
}
