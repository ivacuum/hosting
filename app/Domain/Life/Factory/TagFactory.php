<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\Models\Tag;

class TagFactory
{
    private string|null $titleEn = null;
    private string|null $titleRu = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $title = fake()->word() . ' ' . fake()->randomDigit();

        $tag = new Tag;
        $tag->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $tag->title_en = $this->titleEn ?? $title;
        $tag->title_ru = $this->titleRu ?? $title;

        return $tag;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withTitle(string $titleRu, string $titleEn)
    {
        $factory = clone $this;
        $factory->titleEn = $titleEn;
        $factory->titleRu = $titleRu;

        return $factory;
    }
}
