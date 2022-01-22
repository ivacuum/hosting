<?php namespace App\Factory;

use App\Domain\PhotoStatus;
use App\Photo;
use App\Trip;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Foundation\Testing\WithFaker;

class PhotoFactory
{
    use WithFaker;

    private $slug;
    private $relId;
    private $relType;
    private PhotoStatus $status = PhotoStatus::Published;

    private $tagFactory;
    private $tripFactory;

    public function create()
    {
        $model = $this->make();
        $model->save();

        if ($this->tagFactory instanceof TagFactory) {
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
        $model = new Photo;

        $model->lat = (string) $this->faker->optional(0.9, '')->latitude;
        $model->lon = $model->lat ? (string) $this->faker->longitude : '';
        $model->slug = $this->slug ?? "test/IMG_{$this->faker->numberBetween(1000, 9999)}.jpg";
        $model->point = $model->lat
            ? new Point($model->lat, $model->lon, 4326)
            : null;
        $model->views = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);
        $model->rel_id = $this->relId;
        $model->status = $this->status;
        $model->user_id = 1;
        $model->rel_type = $this->relType;

        if ($this->tripFactory instanceof TripFactory) {
            $trip = $this->tripFactory->create();

            $model->rel_id = $trip->id;
            $model->rel_type = $trip->getMorphClass();
        }

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
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
