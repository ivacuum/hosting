<?php

namespace App\Http\Response;

use App\Domain\Life\Models\Photo;
use Illuminate\Database\Eloquent\Collection;

class PhotoPointCollectionResponse implements \JsonSerializable
{
    /** @param Collection<int, Photo> $photos */
    public function __construct(private Collection $photos) {}

    /**
     * @return array{
     *     groups: list<array{0: string, 1: string, 2: string}>,
     *     points: list<array{0: float, 1: float, 2: int, 3: string}>,
     * }
     */
    #[\Override]
    public function jsonSerialize(): array
    {
        $groups = [];
        $points = [];
        $groupIndexes = [];

        foreach ($this->photos as $photo) {
            $key = "{$photo->rel_type}:{$photo->rel_id}:{$photo->folder()}";

            // Поездку/концерт приводим один раз, чтобы фотки их переиспользовали
            if (!isset($groupIndexes[$key])) {
                $groupIndexes[$key] = count($groups);
                $groups[] = [
                    $photo->rel->www(),
                    sprintf(
                        '%s, %s %s',
                        $photo->rel->title,
                        $photo->isGig() ? $photo->rel->shortDate() : $photo->rel->period(),
                        $photo->rel->year,
                    ),
                    dirname($photo->thumbnailUrl()),
                ];
            }

            $points[] = [
                (float) $photo->point->lat,
                (float) $photo->point->lon,
                $groupIndexes[$key],
                $photo->filename(),
            ];
        }

        return [
            'groups' => $groups,
            'points' => $points,
        ];
    }
}
