<?php

namespace App\Scope;

use App\Domain\TripStatus;
use Illuminate\Database\Eloquent\Builder;

class TripPublishedScope
{
    public function __invoke(Builder $query)
    {
        $query->where('status', TripStatus::Published);
    }
}
