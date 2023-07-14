<?php

namespace App\Action;

use App\Domain\CacheKey;
use App\Http\Response\PhotoPointCollectionResponse;
use App\Photo;
use App\Scope\PhotoForTripScope;
use App\Scope\PhotoOnMapScope;
use App\Scope\PhotoPublishedScope;
use Illuminate\Cache\Repository;

class GetPhotoPointsAction
{
    public function __construct(private Repository $cache)
    {
    }

    public function execute(int|null $tripId): array
    {
        $key = $tripId
            ? CacheKey::PhotosPointsForTrip
            : CacheKey::PhotosPoints;

        return $this->cache->remember($key->value, $key->ttl(), function () use ($tripId) {
            $photos = Photo::query()
                ->with('rel')
                ->tap(new PhotoForTripScope($tripId))
                ->tap(new PhotoPublishedScope)
                ->tap(new PhotoOnMapScope)
                ->orderBy('id')
                ->get();

            return (new PhotoPointCollectionResponse($photos))
                ->jsonSerialize();
        });
    }
}
