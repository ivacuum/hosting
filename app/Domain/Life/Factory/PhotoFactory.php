<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\Models\Photo;
use App\Domain\Life\Models\Trip;
use App\Domain\Life\PhotoStatus;
use App\Spatial\Point;

class PhotoFactory
{
    private int|null $relId = null;
    private string|null $lat = null;
    private string|null $lon = null;
    private string|null $slug = null;
    private string|null $relType = null;
    private PhotoStatus $status = PhotoStatus::Published;

    private TagFactory|null $tagFactory = null;
    private TripFactory|null $tripFactory = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        if ($this->tagFactory) {
            $model->tags()->attach($this->tagFactory->create()->getKey());
        }

        return $model;
    }

    public function hidden()
    {
        return $this->withStatus(PhotoStatus::Hidden);
    }

    public function make()
    {
        $lat = $this->lat ?? (string) fake()->optional(0.9, '')->latitude();
        $lon = $this->lon ?? ($lat ? (string) fake()->longitude() : '');

        $photo = new Photo;
        $photo->slug = $this->slug ?? fake()->numerify('test/IMG_####.jpg');
        $photo->point = $lat
            ? new Point($lat, $lon)
            : null;
        $photo->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $photo->rel_id = $this->relId;
        $photo->status = $this->status;
        $photo->user_id = 1;
        $photo->rel_type = $this->relType;

        if ($this->tripFactory) {
            $trip = $this->tripFactory->create();

            $photo->rel_id = $trip->id;
            $photo->rel_type = $trip->getMorphClass();
        }

        return $photo;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withPoint(string|int $lat, string|int $lon)
    {
        $factory = clone $this;
        $factory->lat = $lat;
        $factory->lon = $lon;

        return $factory;
    }

    public function withSlug(string $slug)
    {
        $factory = clone $this;
        $factory->slug = $slug;

        return $factory;
    }

    public function withStatus(PhotoStatus $status)
    {
        $factory = clone $this;
        $factory->status = $status;

        return $factory;
    }

    public function withTag(TagFactory|null $tagFactory = null)
    {
        $factory = clone $this;
        $factory->tagFactory = $tagFactory ?? TagFactory::new();

        return $factory;
    }

    public function withTrip(TripFactory|null $tripFactory = null)
    {
        $factory = clone $this;
        $factory->tripFactory = $tripFactory ?? TripFactory::new()->metaImage();

        return $factory;
    }

    public function withTripId(int $tripId)
    {
        $factory = clone $this;
        $factory->relId = $tripId;
        $factory->relType = (new Trip)->getMorphClass();

        return $factory;
    }
}
