<?php namespace App\Observers;

use App\Utilities\CacheHelper;

class CountryObserver
{
    private $cache;

    public function __construct(CacheHelper $cache)
    {
        $this->cache = $cache;
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
