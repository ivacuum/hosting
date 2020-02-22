<?php

use App\Factory\TagFactory;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    private const TAGS = [
        ['title_ru' => 'закат', 'title_en' => 'sunset'],
        ['title_ru' => 'железная дорога', 'title_en' => 'railroad'],
        ['title_ru' => 'вокзал', 'title_en' => 'railway terminal'],
        ['title_ru' => 'зима', 'title_en' => 'winter'],
        ['title_ru' => 'панорама', 'title_en' => 'panorama'],
    ];

    public function run()
    {
        foreach (self::TAGS as $tag) {
            $model = TagFactory::new()->make();
            $model->title_en = $tag['title_en'];
            $model->title_ru = $tag['title_ru'];
            $model->save();
        }
    }
}
