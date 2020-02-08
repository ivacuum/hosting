<?php

use App\Factory\CountryFactory;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    const COUNTRIES = [
        ['slug' => 'russia', 'title_ru' => 'Россия', 'title_en' => 'Russia', 'emoji' => '🇷🇺'],
        ['slug' => 'austria', 'title_ru' => 'Австрия', 'title_en' => 'Austria', 'emoji' => '🇦🇹'],
        ['slug' => 'belarus', 'title_ru' => 'Беларусь', 'title_en' => 'Belarus', 'emoji' => '🇧🇾'],
        ['slug' => 'belgium', 'title_ru' => 'Бельгия', 'title_en' => 'Belgium', 'emoji' => '🇧🇪'],
        ['slug' => 'china', 'title_ru' => 'Китай', 'title_en' => 'China', 'emoji' => '🇨🇳'],
        ['slug' => 'czechia', 'title_ru' => 'Чехия', 'title_en' => 'Czechia', 'emoji' => '🇨🇿'],
        ['slug' => 'denmark', 'title_ru' => 'Дания', 'title_en' => 'Denmark', 'emoji' => '🇩🇰'],
        ['slug' => 'finland', 'title_ru' => 'Финляндия', 'title_en' => 'Finland', 'emoji' => '🇫🇮'],
        ['slug' => 'germany', 'title_ru' => 'Германия', 'title_en' => 'Germany', 'emoji' => '🇩🇪'],
        ['slug' => 'hungary', 'title_ru' => 'Венгрия', 'title_en' => 'Hungary', 'emoji' => '🇭🇺'],
        ['slug' => 'italy', 'title_ru' => 'Италия', 'title_en' => 'Italy', 'emoji' => '🇮🇹'],
        ['slug' => 'japan', 'title_ru' => 'Япония', 'title_en' => 'Japan', 'emoji' => '🇯🇵'],
        ['slug' => 'malaysia', 'title_ru' => 'Малайзия', 'title_en' => 'Malaysia', 'emoji' => '🇲🇾'],
        ['slug' => 'netherlands', 'title_ru' => 'Нидерланды', 'title_en' => 'Netherlands', 'emoji' => '🇳🇱'],
        ['slug' => 'spain', 'title_ru' => 'Испания', 'title_en' => 'Spain', 'emoji' => '🇪🇸'],
    ];

    public function run()
    {
        foreach (self::COUNTRIES as $attributes) {
            $country = CountryFactory::new()->make();
            $country->slug = $attributes['slug'];
            $country->emoji = $attributes['emoji'];
            $country->title_en = $attributes['title_en'];
            $country->title_ru = $attributes['title_ru'];
            $country->save();
        }
    }
}
