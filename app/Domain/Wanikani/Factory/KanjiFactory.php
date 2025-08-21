<?php

namespace App\Domain\Wanikani\Factory;

use App\Domain\Wanikani\Models\Kanji;

class KanjiFactory
{
    private int|null $level = null;
    private string|null $character = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $kanji = new Kanji;
        $kanji->level = $this->level ?? fake()->numberBetween(1, 60);
        $kanji->nanori = '';
        $kanji->onyomi = fake()->word();
        $kanji->kunyomi = fake()->word();
        $kanji->meaning = fake()->words(2, true);
        $kanji->character = $this->character ?? fake()->unique()->word();
        $kanji->important_reading = fake()->randomElement(['onyomi', 'kunyomi']);

        return $kanji;
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
}
