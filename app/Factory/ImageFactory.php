<?php namespace App\Factory;

use App\Image;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\WithFaker;

class ImageFactory
{
    use WithFaker;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Image;
        $model->slug = \Str::random(10) . $this->faker->randomElement(['.jpg', '.png']);
        $model->date = CarbonImmutable::instance($this->faker->dateTimeBetween('-4 years'))->format('ymd');
        $model->size = $this->faker->numberBetween(1000, 1_000_000);
        $model->views = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);
        $model->user_id = UserFactory::new()->create()->id;

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }
}
