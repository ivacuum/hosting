<?php

use App\Factory\TagFactory;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    private const TAGS = [
        ['title_ru' => 'закат', 'title_en' => 'sunset'],
        ['title_ru' => 'железная дорога', 'title_en' => 'railroad'],
        ['title_ru' => 'вокзал', 'title_en' => 'railway terminal'],
        ['title_ru' => 'зима', 'title_en' => 'winter'],
        ['title_ru' => 'панорама', 'title_en' => 'panorama'],
        ['title_ru' => 'светофор', 'title_en' => 'traffic light'],
        ['title_ru' => 'супермаркет', 'title_en' => 'supermarket'],
        ['title_ru' => 'такси', 'title_en' => 'taxi'],
        ['title_ru' => 'торговый центр', 'title_en' => 'mall'],
        ['title_ru' => 'трамвай', 'title_en' => 'tram'],
        ['title_ru' => 'туман', 'title_en' => 'fog'],
        ['title_ru' => 'фасад', 'title_en' => 'facade'],
        ['title_ru' => 'флаг', 'title_en' => 'flag'],
        ['title_ru' => 'цветы', 'title_en' => 'flowers'],
        ['title_ru' => 'фонтан', 'title_en' => 'fountain'],
        ['title_ru' => 'часы', 'title_en' => 'clock'],
    ];

    public function run()
    {
        foreach (self::TAGS as $tag) {
            TagFactory::new()
                ->withTitle($tag['title_ru'], $tag['title_en'])
                ->create();
        }
    }
}
