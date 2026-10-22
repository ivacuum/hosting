<?php

namespace App\Domain\Life\Collection;

use App\Domain\Life\Models\Trip;

class LoadTripCityAndCountry
{
    public function __invoke(Trip $trip): Trip
    {
        $trip->loadCityAndCountry();

        return $trip;
    }
}
