<?php

namespace App\Domain\Life\Observer;

use App\Domain\Life\Models\Country;
use App\Utilities\CacheHelper;
use Illuminate\Support\Str;

class CountryObserver
{
    public function __construct(private CacheHelper $cache) {}

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

    public function saving(Country $country)
    {
        $this->maintainConsistency($country);
    }

    private function maintainConsistency(Country $country): void
    {
        $country->slug = Str::trim($country->slug);
        $country->emoji = Str::trim($country->emoji);
        $country->title_en = Str::trim($country->title_en);
        $country->title_ru = Str::trim($country->title_ru);
        $country->hashtags = Str::trim($country->hashtags);
    }
}
