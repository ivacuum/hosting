<?php

namespace App\Seeder;

use App\Utilities\CacheHelper;
use Illuminate\Database\Seeder;

class PruneCache extends Seeder
{
    public function run(CacheHelper $cache)
    {
        $cache->forgetCities();
        $cache->forgetCountries();
        $cache->forgetGigs();
        $cache->forgetMagnets();
        $cache->forgetPhotoPoints();
        $cache->forgetTrips();
    }
}
