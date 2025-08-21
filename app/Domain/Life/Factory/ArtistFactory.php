<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\Models\Artist;

class ArtistFactory
{
    private string|null $slug = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $title = fake()->lexify('??????????');

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
        $factory = clone $this;
        $factory->slug = $slug;

        return $factory;
    }
}
