<?php

namespace App\Domain\Life\Seeder;

use App\Domain\Life\Factory\CountryFactory;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    private const array COUNTRIES = [
        ['slug' => 'russia', 'title_ru' => 'Россия', 'title_en' => 'Russia', 'emoji' => '🇷🇺'],
        ['slug' => 'argentina', 'title_ru' => 'Аргентина', 'title_en' => 'Argentina', 'emoji' => '🇦🇷'],
        ['slug' => 'austria', 'title_ru' => 'Австрия', 'title_en' => 'Austria', 'emoji' => '🇦🇹'],
        ['slug' => 'belarus', 'title_ru' => 'Беларусь', 'title_en' => 'Belarus', 'emoji' => '🇧🇾'],
        ['slug' => 'belgium', 'title_ru' => 'Бельгия', 'title_en' => 'Belgium', 'emoji' => '🇧🇪'],
        ['slug' => 'china', 'title_ru' => 'Китай', 'title_en' => 'China', 'emoji' => '🇨🇳'],
        ['slug' => 'czechia', 'title_ru' => 'Чехия', 'title_en' => 'Czechia', 'emoji' => '🇨🇿'],
        ['slug' => 'denmark', 'title_ru' => 'Дания', 'title_en' => 'Denmark', 'emoji' => '🇩🇰'],
        ['slug' => 'estonia', 'title_ru' => 'Эстония', 'title_en' => 'Estonia', 'emoji' => '🇪🇪'],
        ['slug' => 'finland', 'title_ru' => 'Финляндия', 'title_en' => 'Finland', 'emoji' => '🇫🇮'],
        ['slug' => 'germany', 'title_ru' => 'Германия', 'title_en' => 'Germany', 'emoji' => '🇩🇪'],
        ['slug' => 'hong-kong', 'title_ru' => 'Гонконг', 'title_en' => 'Hongkong', 'emoji' => '🇭🇰'],
        ['slug' => 'hungary', 'title_ru' => 'Венгрия', 'title_en' => 'Hungary', 'emoji' => '🇭🇺'],
        ['slug' => 'iceland', 'title_ru' => 'Исландия', 'title_en' => 'Iceland', 'emoji' => '🇮🇸'],
        ['slug' => 'italy', 'title_ru' => 'Италия', 'title_en' => 'Italy', 'emoji' => '🇮🇹'],
        ['slug' => 'japan', 'title_ru' => 'Япония', 'title_en' => 'Japan', 'emoji' => '🇯🇵'],
        ['slug' => 'malaysia', 'title_ru' => 'Малайзия', 'title_en' => 'Malaysia', 'emoji' => '🇲🇾'],
        ['slug' => 'netherlands', 'title_ru' => 'Нидерланды', 'title_en' => 'Netherlands', 'emoji' => '🇳🇱'],
        ['slug' => 'portugal', 'title_ru' => 'Португалия', 'title_en' => 'Portugal', 'emoji' => '🇵🇹'],
        ['slug' => 'serbia', 'title_ru' => 'Сербия', 'title_en' => 'Serbia', 'emoji' => '🇷🇸'],
        ['slug' => 'singapore', 'title_ru' => 'Сингапур', 'title_en' => 'Singapore', 'emoji' => '🇸🇬'],
        ['slug' => 'south-korea', 'title_ru' => 'Южная Корея', 'title_en' => 'South Korea', 'emoji' => '🇰🇷'],
        ['slug' => 'spain', 'title_ru' => 'Испания', 'title_en' => 'Spain', 'emoji' => '🇪🇸'],
        ['slug' => 'turkey', 'title_ru' => 'Турция', 'title_en' => 'Turkey', 'emoji' => '🇹🇷'],
    ];

    public function run()
    {
        foreach (self::COUNTRIES as [
            'slug' => $slug,
            'title_ru' => $titleRu,
            'title_en' => $titleEn,
            'emoji' => $emoji,
        ]) {
            $country = CountryFactory::new()->make();
            $country->slug = $slug;
            $country->emoji = $emoji;
            $country->hashtags = match ($slug) {
                'hongkong',
                'singapore' => '',
                'russia' => '#russia #россия',
                'south-korea' => '#korea',
                default => str_replace('-', '', "#{$slug}"),
            };
            $country->title_en = $titleEn;
            $country->title_ru = $titleRu;
            $country->save();
        }
    }
}
