<?php namespace App\Factory;

use App\Image;
use Carbon\CarbonImmutable;

class ImageFactory
{
    private int|null $userId = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Image;
        $model->slug = \Str::random(10) . fake()->randomElement(['.jpg', '.png']);
        $model->date = CarbonImmutable::instance(fake()->dateTimeBetween('-4 years'))->format('ymd');
        $model->size = fake()->numberBetween(1000, 1_000_000);
        $model->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $model->user_id = $this->userId ?? UserFactory::new()->create()->id;

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withUserId(int $userId)
    {
        $factory = clone $this;
        $factory->userId = $userId;

        return $factory;
    }
}
