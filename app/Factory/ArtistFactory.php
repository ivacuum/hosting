<?php namespace App\Factory;

use App\Artist;
use Illuminate\Foundation\Testing\WithFaker;

class ArtistFactory
{
    use WithFaker;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $title = $this->faker->lexify('??????????');

        $model = new Artist;
        $model->slug = \Str::slug($title);
        $model->title = $title;

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }
}
