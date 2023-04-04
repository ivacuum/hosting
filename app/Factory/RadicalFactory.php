<?php namespace App\Factory;

use App\Radical;

class RadicalFactory
{
    private int|null $level = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Radical;
        $model->image = '';
        $model->level = $this->level ?? fake()->numberBetween(1, 60);
        $model->meaning = fake()->words(2, true);
        $model->character = fake()->unique()->word();

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withLevel(int $level)
    {
        $factory = clone $this;
        $factory->level = $level;

        return $factory;
    }
}
