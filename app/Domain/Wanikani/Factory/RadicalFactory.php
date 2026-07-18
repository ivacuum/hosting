<?php

namespace App\Domain\Wanikani\Factory;

use App\Domain\Wanikani\Models\Radical;

class RadicalFactory
{
    private int|null $level = null;

    public function create(): Radical
    {
        $radical = $this->make();
        $radical->save();

        return $radical;
    }

    public function make(): Radical
    {
        $radical = new Radical;
        $radical->level = $this->level ?? fake()->numberBetween(1, 60);
        $radical->wk_id = fake()->unique()->numberBetween(3_000_000_000, 4_294_967_295);
        $radical->meaning = 'radical-' . fake()->uuid();
        $radical->character = fake()->word();

        return $radical;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withLevel(int $level): self
    {
        return clone ($this, ['level' => $level]);
    }
}
