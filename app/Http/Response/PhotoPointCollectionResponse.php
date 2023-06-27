<?php

namespace App\Http\Response;

use Illuminate\Database\Eloquent\Collection;

class PhotoPointCollectionResponse implements \JsonSerializable
{
    public function __construct(private Collection $photos)
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => 'FeatureCollection',
            'features' => $this->photos
                ->mapInto(PhotoPointResponse::class)
                ->jsonSerialize(),
        ];
    }
}
