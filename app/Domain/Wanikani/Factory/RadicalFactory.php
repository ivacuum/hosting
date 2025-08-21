<?php

namespace App\Domain\Wanikani\Factory;

use App\Domain\Wanikani\Models\Radical;

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
        $radical = new Radical;
        $radical->image = '';
        $radical->level = $this->level ?? fake()->numberBetween(1, 60);
        $radical->meaning = fake()->words(2, true);
        $radical->character = fake()->unique()->word();

        return $radical;
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
