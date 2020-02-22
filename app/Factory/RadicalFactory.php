<?php namespace App\Factory;

use App\Radical;
use Illuminate\Foundation\Testing\WithFaker;

class RadicalFactory
{
    use WithFaker;

    private $level;

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
        $model->level = $this->level ?? $this->faker->numberBetween(1, 60);
        $model->meaning = $this->faker->words(2, true);
        $model->character = $this->faker->unique()->word;

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }

    public function withLevel(int $level)
    {
        $factory = clone $this;
        $factory->level = $level;

        return $factory;
    }
}
