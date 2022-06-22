<?php namespace App\Factory;

use App\Kanji;

class KanjiFactory
{
    private $level;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Kanji;
        $model->level = $this->level ?? fake()->numberBetween(1, 60);
        $model->nanori = '';
        $model->onyomi = fake()->word();
        $model->kunyomi = fake()->word();
        $model->meaning = fake()->words(2, true);
        $model->character = fake()->unique()->word();
        $model->important_reading = fake()->randomElement(['onyomi', 'kunyomi']);

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
