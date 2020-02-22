<?php namespace App\Factory;

use App\Photo;
use Illuminate\Foundation\Testing\WithFaker;

class PhotoFactory
{
    use WithFaker;

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

    public function make()
    {
        $model = new Photo;

        $model->lat = $this->faker->latitude;
        $model->lon = $this->faker->longitude;
        $model->slug = "test/IMG_{$this->faker->numberBetween(1000, 9999)}.jpg";
        $model->views = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);
        $model->status = Photo::STATUS_PUBLISHED;
        $model->user_id = 1;

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
}
