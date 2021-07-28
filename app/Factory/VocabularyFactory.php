<?php namespace App\Factory;

use App\Vocabulary;
use Illuminate\Foundation\Testing\WithFaker;

class VocabularyFactory
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
        $model = new Vocabulary;

        $model->kana = $this->faker->word;
        $model->level = $this->level ?? $this->faker->numberBetween(1, 60);
        $model->meaning = $this->faker->words(2, true);
        $model->character = $this->faker->unique()->word();
        $model->sentences = $this->faker->sentence;

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
