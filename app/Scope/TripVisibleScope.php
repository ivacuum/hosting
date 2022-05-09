<?php namespace App\Scope;

use App\Domain\TripStatus;
use Illuminate\Database\Eloquent\Builder;

class TripVisibleScope
{
    public function __invoke(Builder $query)
    {
        $query->where('status', '!=', TripStatus::Hidden);
    }
}
