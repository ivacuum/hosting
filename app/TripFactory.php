<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\Finder\Finder;

class TripFactory
{
    public static function forInputSelect()
    {
        return Trip::orderByDesc('date_start')->pluck('slug', 'id');
    }

    /**
     * @return \Symfony\Component\Finder\Finder|\Symfony\Component\Finder\SplFileInfo[]
     */
    public static function templatesIterator()
    {
        return Finder::create()
            ->files()
            ->in(resource_path('views/life/trips'))
            ->name('*.blade.php')
            ->notName('base.blade.php')
            ->sortByName();
    }

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
