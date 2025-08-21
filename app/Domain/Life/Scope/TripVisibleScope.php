<?php

namespace App\Domain\Life\Scope;

use App\Domain\Life\TripStatus;
use Illuminate\Database\Eloquent\Builder;

class TripVisibleScope
{
    public function __invoke(Builder $query)
    {
        $query->where('status', '!=', TripStatus::Hidden);
    }
}
