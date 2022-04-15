<?php namespace App;

use Illuminate\Database\Eloquent\Builder;

class TripFactory
{
    public static function tripsByCities(int $userId = 0)
    {
        $tripsByCities = [];

        Trip::query()
            ->when($userId > 0, fn (Builder $query) => $query->where('user_id', $userId))
            ->visible()
            ->get(['id', 'city_id', 'status'])
            ->each(function (Trip $trip) use (&$tripsByCities) {
                if ($trip->status->isPublished()) {
                    @$tripsByCities[$trip->city_id]['published'] += 1;
                }

                @$tripsByCities[$trip->city_id]['total'] += 1;
            });

        return collect($tripsByCities);
    }
}
