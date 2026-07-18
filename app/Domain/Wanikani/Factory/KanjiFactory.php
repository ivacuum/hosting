<?php

namespace App\Domain\Wanikani\Factory;

use App\Domain\Wanikani\Models\Kanji;

class KanjiFactory
{
    private int|null $level = null;
    private string|null $character = null;

    public function create(): Kanji
    {
        $kanji = $this->make();
        $kanji->save();

        return $kanji;
    }

    public function make(): Kanji
    {
        $kanji = new Kanji;
        $kanji->level = $this->level ?? fake()->numberBetween(1, 60);
        $kanji->wk_id = fake()->unique()->numberBetween(3_000_000_000, 4_294_967_295);
        $kanji->nanori = '';
        $kanji->onyomi = fake()->word();
        $kanji->kunyomi = fake()->word();
        $kanji->meaning = fake()->words(2, true);
        $kanji->character = $this->character ?? 'kanji-' . fake()->uuid();
        $kanji->important_reading = fake()->randomElement(['onyomi', 'kunyomi']);

        return $kanji;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withCharacter(string $character): self
    {
        return clone ($this, ['character' => $character]);
    }

    #[\NoDiscard]
    public function withLevel(int $level): self
    {
        return clone ($this, ['level' => $level]);
    }
}
