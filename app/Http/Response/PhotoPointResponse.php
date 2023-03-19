<?php namespace App\Http\Response;

use App\Photo;

class PhotoPointResponse implements \JsonSerializable
{
    public function __construct(private Photo $photo)
    {
    }

    public function jsonSerialize(): array
    {
        $basename = basename($this->photo->slug);

        return [
            'type' => 'Feature',
            'id' => $this->photo->id,
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [$this->photo->point->lat, $this->photo->point->lon],
            ],
            'properties' => [
                'balloonContent' => sprintf(
                    '<div><a href="%s#%s">%s, %s %s<br><img class="mt-1 image-200 object-cover rounded" src="%s" alt=""></a></div>',
                    $this->photo->rel->www(),
                    $basename,
                    $this->photo->rel->title,
                    $this->photo->rel->period(),
                    $this->photo->rel->year,
                    $this->photo->thumbnailUrl()
                ),
                'clusterCaption' => $basename,
            ],
        ];
    }
}
