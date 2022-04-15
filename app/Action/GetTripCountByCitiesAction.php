<?php namespace App\Action;

use App\Trip;
use Illuminate\Database\Eloquent\Builder;

class GetTripCountByCitiesAction
{
    /** @return array<int, array{published: int, total: int}> */
    public function execute(int $userId = 0): array
    {
        $tripCount = [];

        Trip::query()
            ->when($userId > 0, fn (Builder $query) => $query->where('user_id', $userId))
            ->visible()
            ->get(['id', 'city_id', 'status'])
            ->each(function (Trip $trip) use (&$tripCount) {
                if ($trip->status->isPublished()) {
                    @$tripCount[$trip->city_id]['published'] += 1;
                }

                @$tripCount[$trip->city_id]['total'] += 1;
            });

        return $tripCount;
    }
}
