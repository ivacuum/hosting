<?php

namespace App\Scope;

use App\Domain\TripStatus;
use App\Trip;
use Illuminate\Database\Eloquent\Builder;

class TripPreviousScope
{
    public function __construct(private Trip $trip, private int $nextTrips = 2)
    {
    }

    public function __invoke(Builder $query)
    {
        // Всего 4 места под ссылки помимо текущей поездки
        // prev prev current next next
        // При просмотре последней поездки будет
        // prev prev prev prev current
        $take = 4 - $this->nextTrips;

        return $query->where('user_id', $this->trip->user_id)
            ->where('date_start', '<=', $this->trip->date_start)
            ->where('status', TripStatus::Published)
            ->where('id', '<>', $this->trip->id)
            ->orderByDesc('date_start')
            ->take($take);
    }
}
