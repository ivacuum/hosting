<?php

namespace App\Domain\Wanikani\Factory;

use App\Domain\Wanikani\Models\Vocabulary;

class VocabularyFactory
{
    private int|null $level = null;
    private string|null $kana = null;
    private string|null $character = null;

    public function create(): Vocabulary
    {
        $vocab = $this->make();
        $vocab->save();

        return $vocab;
    }

    public function make(): Vocabulary
    {
        $vocab = new Vocabulary;

        $vocab->kana = $this->kana ?? fake()->word();
        $vocab->level = $this->level ?? fake()->numberBetween(1, 60);
        $vocab->wk_id = fake()->unique()->numberBetween(3_000_000_000, 4_294_967_295);
        $vocab->meaning = fake()->words(2, true);
        $vocab->character = $this->character ?? 'vocabulary-' . fake()->uuid();
        $vocab->sentences = fake()->sentence();

        return $vocab;
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

    #[\NoDiscard]
    public function withKana(string $kana): self
    {
        return clone ($this, ['kana' => $kana]);
    }
}
