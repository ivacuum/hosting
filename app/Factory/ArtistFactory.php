<?php namespace App\Factory;

use App\Artist;

class ArtistFactory
{
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
        $model->slug = \Str::slug($title);
        $model->title = $title;

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }
}
