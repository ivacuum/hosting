<?php namespace App\Factory;

use App\Tag;
use Illuminate\Foundation\Testing\WithFaker;

class TagFactory
{
    use WithFaker;

    private $titleEn;
    private $titleRu;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $title = "{$this->faker->word} {$this->faker->randomDigit()}";

        $model = new Tag;
        $model->views = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);
        $model->title_en = $this->titleEn ?? $title;
        $model->title_ru = $this->titleRu ?? $title;

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }

    public function withTitle(string $titleRu, string $titleEn)
    {
        $factory = clone $this;
        $factory->titleEn = $titleEn;
        $factory->titleRu = $titleRu;

        return $factory;
    }
}
