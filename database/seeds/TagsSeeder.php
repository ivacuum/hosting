<?php

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    const TAGS = [
        ['title_ru' => 'закат', 'title_en' => 'sunset'],
        ['title_ru' => 'железная дорога', 'title_en' => 'railroad'],
        ['title_ru' => 'вокзал', 'title_en' => 'railway terminal'],
        ['title_ru' => 'зима', 'title_en' => 'winter'],
        ['title_ru' => 'панорама', 'title_en' => 'panorama'],
    ];

    public function run()
    {
        foreach (self::TAGS as $tag) {
            factory(App\Tag::class)->create($tag);
        }
    }
}
