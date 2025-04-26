<?php

namespace App\Collection;

use App\Trip;

class LoadTripCityAndCountry
{
    public function __invoke(Trip $trip)
    {
        $trip->loadCityAndCountry();

        return $trip;
    }
}
