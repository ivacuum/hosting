<?php namespace App\Factory;

use App\Tag;

class TagFactory
{
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
        $title = fake()->word() . ' ' . fake()->randomDigit();

        $model = new Tag;
        $model->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $model->title_en = $this->titleEn ?? $title;
        $model->title_ru = $this->titleRu ?? $title;

        return $model;
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
