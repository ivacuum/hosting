<?php namespace App;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Finder\Finder;

class TripFactory
{
    public static function forInputSelect()
    {
        return Trip::orderByDesc('date_start')->pluck('slug', 'id');
    }

    public static function idsByCity(?int $id = null)
    {
        $ids = \Cache::rememberForever(CacheKey::TRIPS_PUBLISHED_BY_CITY, function () {
            $trips = Trip::published()->get(['id', 'city_id']);
            $result = [];

            /** @var Trip $trip */
            foreach ($trips as $trip) {
                $result[$trip->city_id][] = $trip->id;
            }

            return $result;
        });

        if ($id && !empty($ids[$id])) {
            return $ids[$id];
        }

        return $ids;
    }

    public static function idsByCountry(?int $id = null)
    {
        $ids = \Cache::rememberForever(CacheKey::TRIPS_PUBLISHED_BY_COUNTRY, function () {
            $trips = Trip::query()
                ->published()
                ->with('city:id,country_id')
                ->get(['id', 'city_id']);

            $result = [];

            /** @var Trip $trip */
            foreach ($trips as $trip) {
                $result[$trip->city->country_id][] = $trip->id;
            }

            return $result;
        });

        if ($id && !empty($ids[$id])) {
            return $ids[$id];
        }

        return $ids;
    }

    /**
     * @return \Symfony\Component\Finder\Finder|\Symfony\Component\Finder\SplFileInfo[]
     */
    public static function templatesIterator()
    {
        return Finder::create()
            ->files()
            ->in(base_path('resources/views/life/trips'))
            ->name('*.blade.php')
            ->notName('base.blade.php')
            ->sortByName();
    }

    public static function tripsByCities(int $userId = 0)
    {
        $tripsByCities = [];

        Trip::query()
            ->when($userId > 0, function (Builder $query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->visible()
            ->get(['id', 'city_id', 'status'])
            ->each(function (Trip $trip) use (&$tripsByCities) {
                if ($trip->isPublished()) {
                    @$tripsByCities[$trip->city_id]['published'] += 1;
                }

                @$tripsByCities[$trip->city_id]['total'] += 1;
            });

        return collect($tripsByCities);
    }

    public static function tripsWithCover(?int $count = null)
    {
        return \Cache::remember(CacheKey::TRIPS_PUBLISHED_WITH_COVER, CarbonInterval::day(), function () {
            // Не нужно ограничение по пользователю, так как meta_image есть только у user_id=1
            return Trip::query()
                ->published()
                ->where('meta_image', '<>', '')
                ->orderByDesc('date_start')
                ->get();
        })->when($count > 0, function (Collection $trips) use ($count) {
            return $trips->count() > $count
                ? $trips->random($count)
                : $trips;
        });
    }
}
