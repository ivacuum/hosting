<?php

namespace App\Domain\Wanikani\Factory;

use App\Domain\Wanikani\Models\Vocabulary;

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
        $vocab = new Vocabulary;

        $vocab->kana = $this->kana ?? fake()->word();
        $vocab->level = $this->level ?? fake()->numberBetween(1, 60);
        $vocab->meaning = fake()->words(2, true);
        $vocab->character = $this->character ?? fake()->unique()->word();
        $vocab->sentences = fake()->sentence();

        return $vocab;
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
