<?php namespace App\Factory;

use App\Kanji;
use Illuminate\Foundation\Testing\WithFaker;

class KanjiFactory
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
        $model = new Kanji;
        $model->level = $this->level ?? $this->faker->numberBetween(1, 60);
        $model->nanori = '';
        $model->onyomi = $this->faker->word;
        $model->meaning = $this->faker->words(2, true);
        $model->character = $this->faker->unique()->word();
        $model->kunyomi = $this->faker->word;
        $model->important_reading = $this->faker->randomElement(['onyomi', 'kunyomi']);

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
