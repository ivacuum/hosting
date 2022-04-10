<?php namespace App\Action;

use App\Domain\CacheKey;
use App\Http\Response\PhotoPointCollectionResponse;
use App\Photo;
use Illuminate\Cache\Repository;

class GetPhotoPointsAction
{
    public function __construct(private Repository $cache)
    {
    }

    public function execute(?int $tripId): array
    {
        $key = $tripId
            ? CacheKey::PhotosPointsForTrip
            : CacheKey::PhotosPoints;

        return $this->cache->remember($key->value, $key->ttl(), function () use ($tripId) {
            $photos = Photo::query()
                ->with('rel')
                ->forTrip($tripId)
                ->published()
                ->onMap()
                ->orderBy('id')
                ->get();

            return (new PhotoPointCollectionResponse($photos))
                ->jsonSerialize();
        });
    }
}
