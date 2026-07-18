<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\Models\Artist;

class ArtistFactory
{
    private string|null $slug = null;
    private string|null $title = null;

    public function create(): Artist
    {
        $artist = $this->make();
        $artist->save();

        return $artist;
    }

    public function make(): Artist
    {
        $title = $this->title ?? fake()->lexify('??????????');

        $artist = new Artist;
        $artist->slug = $this->slug ?? \Str::slug($title);
        $artist->title = $title;

        return $artist;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withSlug(string $slug): self
    {
        return clone ($this, ['slug' => $slug]);
    }

    #[\NoDiscard]
    public function withTitle(string $title): self
    {
        return clone ($this, ['title' => $title]);
    }
}
