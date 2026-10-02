<?php

namespace App\Domain\Life\Action;

use App\Domain\CacheKey;
use App\Domain\Life\Models\Photo;
use App\Domain\Life\Scope\PhotoForTripScope;
use App\Domain\Life\Scope\PhotoOnMapScope;
use App\Domain\Life\Scope\PhotoPublishedScope;
use App\Http\Response\PhotoPointCollectionResponse;
use Illuminate\Cache\Repository;

class GetPhotoPointsAction
{
    public function __construct(private Repository $cache) {}

    public function execute(int|null $tripId): array
    {
        if ($tripId !== null) {
            return $this->photoPoints($tripId);
        }

        $key = CacheKey::PhotosPoints;

        return $this->cache->remember(
            $key->key(app()->getLocale()),
            $key->ttl(),
            fn (): array => $this->photoPoints(null),
        );
    }

    private function photoPoints(int|null $tripId): array
    {
        $photos = Photo::query()
            ->with('rel')
            ->tap(new PhotoForTripScope($tripId))
            ->tap(new PhotoPublishedScope)
            ->tap(new PhotoOnMapScope)
            ->orderBy('id')
            ->get();

        return new PhotoPointCollectionResponse($photos)
            ->jsonSerialize();
    }
}
