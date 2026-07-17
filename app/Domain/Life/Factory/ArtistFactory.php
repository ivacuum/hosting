<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\Models\Artist;

class ArtistFactory
{
    private string|null $slug = null;
    private string|null $title = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
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

    public function withSlug(string $slug)
    {
        return clone ($this, ['slug' => $slug]);
    }

    public function withTitle(string $title)
    {
        return clone ($this, ['title' => $title]);
    }
}
