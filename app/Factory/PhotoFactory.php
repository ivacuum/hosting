<?php namespace App\Factory;

use App\Domain\PhotoStatus;
use App\Photo;
use App\Spatial\Point;
use App\Trip;

class PhotoFactory
{
    private int|null $relId = null;
    private string|null $lat = null;
    private string|null $lon = null;
    private string|null $slug = null;
    private string|null $relType = null;
    private PhotoStatus $status = PhotoStatus::Published;

    private ?TagFactory $tagFactory = null;
    private ?TripFactory $tripFactory = null;

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

        $model = new Photo;
        $model->slug = $this->slug ?? fake()->numerify('test/IMG_####.jpg');
        $model->point = $lat
            ? new Point($lat, $lon)
            : null;
        $model->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $model->rel_id = $this->relId;
        $model->status = $this->status;
        $model->user_id = 1;
        $model->rel_type = $this->relType;

        if ($this->tripFactory) {
            $trip = $this->tripFactory->create();

            $model->rel_id = $trip->id;
            $model->rel_type = $trip->getMorphClass();
        }

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withPoint(string $lat, string $lon)
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

    public function withTag(TagFactory $tagFactory = null)
    {
        $factory = clone $this;
        $factory->tagFactory = $tagFactory ?? TagFactory::new();

        return $factory;
    }

    public function withTrip(TripFactory $tripFactory = null)
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
