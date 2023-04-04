<?php namespace App\Factory;

use App\Vocabulary;

class VocabularyFactory
{
    private int|null $level = null;
    private string|null $kana = null;
    private string|null $character = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Vocabulary;

        $model->kana = $this->kana ?? fake()->word();
        $model->level = $this->level ?? fake()->numberBetween(1, 60);
        $model->meaning = fake()->words(2, true);
        $model->character = $this->character ?? fake()->unique()->word();
        $model->sentences = fake()->sentence();

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withCharacter(string $character)
    {
        $factory = clone $this;
        $factory->character = $character;

        return $factory;
    }

    public function withLevel(int $level)
    {
        $factory = clone $this;
        $factory->level = $level;

        return $factory;
    }

    public function withKana(string $kana)
    {
        $factory = clone $this;
        $factory->kana = $kana;

        return $factory;
    }
}
