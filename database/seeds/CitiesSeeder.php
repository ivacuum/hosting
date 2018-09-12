<?php

use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    const CITIES_BY_COUNTRY = [
        'russia' => [
            ['slug' => 'kaluga', 'title_ru' => 'Калуга', 'title_en' => 'Kaluga'],
            ['slug' => 'msk', 'title_ru' => 'Москва', 'title_en' => 'Moscow'],
            ['slug' => 'spb', 'title_ru' => 'Санкт-Петербург', 'title_en' => 'Saint Petersburg'],
            ['slug' => 'yakutsk', 'title_ru' => 'Якутск', 'title_en' => 'Yakutsk'],
            ['slug' => 'samara', 'title_ru' => 'Самара', 'title_en' => 'Samara'],
        ],
        'austria' => [
            ['slug' => 'vienna', 'title_ru' => 'Вена', 'title_en' => 'Vienna'],
        ],
        'belarus' => [
            ['slug' => 'minsk', 'title_ru' => 'Минск', 'title_en' => 'Minsk'],
        ],
        'belgium' => [
            ['slug' => 'bruges', 'title_ru' => 'Брюгге', 'title_en' => 'Bruges'],
            ['slug' => 'brussels', 'title_ru' => 'Брюссель', 'title_en' => 'Brussels'],
            ['slug' => 'ghent', 'title_ru' => 'Гент', 'title_en' => 'Ghent'],
        ],
        'china' => [
            ['slug' => 'shanghai', 'title_ru' => 'Шанхай', 'title_en' => 'Shanghai'],
        ],
        'czechia' => [
            ['slug' => 'brno', 'title_ru' => 'Брно', 'title_en' => 'Brno'],
            ['slug' => 'prague', 'title_ru' => 'Прага', 'title_en' => 'Prague'],
        ],
        'denmark' => [
            ['slug' => 'copenhagen', 'title_ru' => 'Копенгаген', 'title_en' => 'Copenhagen'],
        ],
        'finland' => [
            ['slug' => 'helsinki', 'title_ru' => 'Хельсинки', 'title_en' => 'Helsinki'],
        ],
        'germany' => [
            ['slug' => 'berlin', 'title_ru' => 'Берлин', 'title_en' => 'Berlin'],
            ['slug' => 'dresden', 'title_ru' => 'Дрезден', 'title_en' => 'Dresden'],
            ['slug' => 'frankfurt', 'title_ru' => 'Франкфурт', 'title_en' => 'Frankfurt'],
            ['slug' => 'hamburg', 'title_ru' => 'Гамбург', 'title_en' => 'Hamburg'],
            ['slug' => 'wiesbaden', 'title_ru' => 'Висбаден', 'title_en' => 'Wiesbaden'],
        ],
        'hungary' => [
            ['slug' => 'budapest', 'title_ru' => 'Будапешт', 'title_en' => 'Budapest'],
        ],
        'italy' => [
            ['slug' => 'milan', 'title_ru' => 'Милан', 'title_en' => 'Milan'],
            ['slug' => 'rome', 'title_ru' => 'Рим', 'title_en' => 'Rome'],
        ],
        'japan' => [
            ['slug' => 'osaka', 'title_ru' => 'Осака', 'title_en' => 'Osaka'],
            ['slug' => 'kyoto', 'title_ru' => 'Киото', 'title_en' => 'Kyoto'],
            ['slug' => 'sapporo', 'title_ru' => 'Саппоро', 'title_en' => 'Sapporo'],
            ['slug' => 'tokyo', 'title_ru' => 'Токио', 'title_en' => 'Tokyo'],
        ],
        'malaysia' => [
            ['slug' => 'kuala-lumpur', 'title_ru' => 'Куала-Лумпур', 'title_en' => 'Kuala Lumpur'],
        ],
        'netherlands' => [
            ['slug' => 'amsterdam', 'title_ru' => 'Амстердам', 'title_en' => 'Amsterdam'],
            ['slug' => 'rotterdam', 'title_ru' => 'Роттердам', 'title_en' => 'Rotterdam'],
        ],
        'spain' => [
            ['slug' => 'barcelona', 'title_ru' => 'Барселона', 'title_en' => 'Barcelona'],
        ],
    ];

    public function run()
    {
        foreach (self::CITIES_BY_COUNTRY as $country => $cities) {
            $city_models = array_map(function ($city) {
                return factory(App\City::class)->make($city);
            }, $cities);

            App\Country::query()
                ->where('slug', $country)
                ->first()
                ->cities()
                ->saveMany($city_models);
        }
    }
}
