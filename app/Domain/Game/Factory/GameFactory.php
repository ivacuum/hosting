<?php

namespace App\Domain\Game\Factory;

use App\Domain\Game\Models\Game;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;

class GameFactory
{
    private int|null $steamId = null;
    private string|null $slug = null;
    private string|null $title = null;
    private string|null $shortDescriptionEn = null;
    private string|null $shortDescriptionRu = null;
    private CarbonInterface|null $finishedAt = null;
    private CarbonInterface|null $releasedAt = null;

    public function create(): Game
    {
        $game = $this->make();
        $game->save();

        return $game;
    }

    public function make(): Game
    {
        $game = new Game;
        $game->slug = $this->slug ?? 'game-' . fake()->uuid();
        $game->title = $this->title ?? fake()->company();
        $game->steam_id = $this->steamId ?? fake()->unique()->numberBetween(3_000_000_000, 4_294_967_295);
        $game->finished_at = $this->finishedAt;
        $game->released_at = $this->releasedAt ?? fake()->dateTimeBetween('1998-01-01');
        $game->short_description_en = $this->shortDescriptionEn ?? fake()->sentences(2, asText: true);
        $game->short_description_ru = $this->shortDescriptionRu ?? fake()->sentences(2, asText: true);

        return $game;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withFinishedAt(CarbonInterface|string $finishedAt): self
    {
        return clone ($this, [
            'finishedAt' => $finishedAt instanceof CarbonInterface
                ? $finishedAt
                : CarbonImmutable::make($finishedAt),
        ]);
    }

    #[\NoDiscard]
    public function withReleasedAt(CarbonInterface|string $releasedAt): self
    {
        return clone ($this, [
            'releasedAt' => $releasedAt instanceof CarbonInterface
                ? $releasedAt
                : CarbonImmutable::make($releasedAt),
        ]);
    }

    #[\NoDiscard]
    public function withShortDescriptionEn(string $shortDescription): self
    {
        return clone ($this, ['shortDescriptionEn' => $shortDescription]);
    }

    #[\NoDiscard]
    public function withShortDescriptionRu(string $shortDescription): self
    {
        return clone ($this, ['shortDescriptionRu' => $shortDescription]);
    }

    #[\NoDiscard]
    public function withSlug(string $slug): self
    {
        return clone ($this, ['slug' => $slug]);
    }

    #[\NoDiscard]
    public function withSteamId(int $steamId): self
    {
        return clone ($this, ['steamId' => $steamId]);
    }

    #[\NoDiscard]
    public function withTitle(string $title): self
    {
        return clone ($this, ['title' => $title]);
    }
}
