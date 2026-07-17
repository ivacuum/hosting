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

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
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

    public function withFinishedAt(CarbonInterface|string $finishedAt)
    {
        return clone ($this, [
            'finishedAt' => $finishedAt instanceof CarbonInterface
                ? $finishedAt
                : CarbonImmutable::make($finishedAt),
        ]);
    }

    public function withReleasedAt(CarbonInterface|string $releasedAt)
    {
        return clone ($this, [
            'releasedAt' => $releasedAt instanceof CarbonInterface
                ? $releasedAt
                : CarbonImmutable::make($releasedAt),
        ]);
    }

    public function withShortDescriptionEn(string $shortDescription)
    {
        return clone ($this, ['shortDescriptionEn' => $shortDescription]);
    }

    public function withShortDescriptionRu(string $shortDescription)
    {
        return clone ($this, ['shortDescriptionRu' => $shortDescription]);
    }

    public function withSlug(string $slug)
    {
        return clone ($this, ['slug' => $slug]);
    }

    public function withSteamId(int $steamId)
    {
        return clone ($this, ['steamId' => $steamId]);
    }

    public function withTitle(string $title)
    {
        return clone ($this, ['title' => $title]);
    }
}
