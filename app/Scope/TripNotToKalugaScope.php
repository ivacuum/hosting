<?php

namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;

class TripNotToKalugaScope
{
    public function __invoke(Builder $query)
    {
        $query->where('city_id', '<>', 1);
    }
}
