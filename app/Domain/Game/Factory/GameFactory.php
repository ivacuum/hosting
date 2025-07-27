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
        $game->slug = $this->slug ?? fake()->slug();
        $game->title = $this->title ?? fake()->company();
        $game->steam_id = $this->steamId;
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
        $factory = clone $this;
        $factory->finishedAt = $finishedAt instanceof CarbonInterface
            ? $finishedAt
            : CarbonImmutable::make($finishedAt);

        return $factory;
    }

    public function withReleasedAt(CarbonInterface|string $releasedAt)
    {
        $factory = clone $this;
        $factory->releasedAt = $releasedAt instanceof CarbonInterface
            ? $releasedAt
            : CarbonImmutable::make($releasedAt);

        return $factory;
    }

    public function withShortDescriptionEn(string $shortDescription)
    {
        $factory = clone $this;
        $factory->shortDescriptionEn = $shortDescription;

        return $factory;
    }

    public function withShortDescriptionRu(string $shortDescription)
    {
        $factory = clone $this;
        $factory->shortDescriptionRu = $shortDescription;

        return $factory;
    }

    public function withSlug(string $slug)
    {
        $factory = clone $this;
        $factory->slug = $slug;

        return $factory;
    }

    public function withSteamId(int $steamId)
    {
        $factory = clone $this;
        $factory->steamId = $steamId;

        return $factory;
    }

    public function withTitle(string $title)
    {
        $factory = clone $this;
        $factory->title = $title;

        return $factory;
    }
}
