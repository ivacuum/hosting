<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\Models\Tag;

class TagFactory
{
    private string|null $titleEn = null;
    private string|null $titleRu = null;

    public function create(): Tag
    {
        $tag = $this->make();
        $tag->save();

        return $tag;
    }

    public function make(): Tag
    {
        $title = 'tag-' . fake()->uuid();

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

    #[\NoDiscard]
    public function withTitle(string $titleRu, string $titleEn): self
    {
        return clone ($this, [
            'titleEn' => $titleEn,
            'titleRu' => $titleRu,
        ]);
    }
}
