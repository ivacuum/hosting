<?php

namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;

class TripWithCoverScope
{
    public function __invoke(Builder $query)
    {
        $query->where('meta_image', '<>', '');
    }
}
