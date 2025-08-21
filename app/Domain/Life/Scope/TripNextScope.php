<?php

namespace App\Domain\Life\Scope;

use App\Domain\Life\Models\Trip;
use App\Domain\Life\TripStatus;
use Illuminate\Database\Eloquent\Builder;

class TripNextScope
{
    public function __construct(private Trip $trip) {}

    public function __invoke(Builder $query)
    {
        $query->where('user_id', $this->trip->user_id)
            ->where('date_start', '>=', $this->trip->date_start)
            ->where('status', TripStatus::Published)
            ->where('id', '<>', $this->trip->id)
            ->orderBy('date_start')
            ->take(2);
    }
}
