<?php namespace App\Factory;

use App\Artist;

class ArtistFactory
{
    private $slug;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $title = fake()->lexify('??????????');

        $model = new Artist;
        $model->slug = $this->slug ?? \Str::slug($title);
        $model->title = $title;

        return $model;
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
