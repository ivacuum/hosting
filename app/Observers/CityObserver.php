<?php

namespace App\Observers;

use App\City;
use App\Utilities\CacheHelper;
use Illuminate\Support\Str;

class CityObserver
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

    public function saving(City $city)
    {
        $this->maintainConsistency($city);
    }

    private function maintainConsistency(City $city): void
    {
        $city->iata = Str::trim($city->iata);
        $city->slug = Str::trim($city->slug);
        $city->hashtags = Str::trim($city->hashtags);
        $city->title_en = Str::trim($city->title_en);
        $city->title_ru = Str::trim($city->title_ru);

        if ($city->iata && mb_strlen($city->iata) !== 3) {
            throw new \DomainException('IATA code can only be three characters long.');
        }
    }
}
