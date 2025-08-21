<?php

namespace App\Domain\Life\Scope;

use App\Domain\Life\TripStatus;
use Illuminate\Database\Eloquent\Builder;

class TripPublishedScope
{
    public function __invoke(Builder $query)
    {
        $query->where('status', TripStatus::Published);
    }
}
