<?php

namespace App\Seeder;

use App\Country;
use App\Factory\CityFactory;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    private const array CITIES_BY_COUNTRY = [
        'russia' => [
            ['slug' => 'kaluga', 'title_ru' => 'Калуга', 'title_en' => 'Kaluga'],
            ['slug' => 'msk', 'title_ru' => 'Москва', 'title_en' => 'Moscow'],
            ['slug' => 'spb', 'title_ru' => 'Санкт-Петербург', 'title_en' => 'Saint Petersburg'],
            ['slug' => 'yakutsk', 'title_ru' => 'Якутск', 'title_en' => 'Yakutsk'],
            ['slug' => 'samara', 'title_ru' => 'Самара', 'title_en' => 'Samara'],
        ],
        'argentina' => [
            ['slug' => 'buenos-aires', 'title_ru' => 'Буэнос-Айрес', 'title_en' => 'Buenos Aires'],
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
        'estonia' => [
            ['slug' => 'narva', 'title_ru' => 'Нарва', 'title_en' => 'Narva'],
            ['slug' => 'parnu', 'title_ru' => 'Пярну', 'title_en' => 'Pärnu'],
            ['slug' => 'tallinn', 'title_ru' => 'Таллинн', 'title_en' => 'Tallinn'],
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
        'hong-kong' => [
            ['slug' => 'hong-kong', 'title_ru' => 'Гонконг', 'title_en' => 'Hong Kong'],
        ],
        'hungary' => [
            ['slug' => 'budapest', 'title_ru' => 'Будапешт', 'title_en' => 'Budapest'],
        ],
        'iceland' => [
            ['slug' => 'reykjavik', 'title_ru' => 'Рейкьявик', 'title_en' => 'Reykjavik'],
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
        'portugal' => [
            ['slug' => 'lisbon', 'title_ru' => 'Лиссабон', 'title_en' => 'Lisbon'],
            ['slug' => 'porto', 'title_ru' => 'Порту', 'title_en' => 'Porto'],
        ],
        'serbia' => [
            ['slug' => 'belgrade', 'title_ru' => 'Белград', 'title_en' => 'Belgrade'],
            ['slug' => 'novi-sad', 'title_ru' => 'Нови Сад', 'title_en' => 'Novi Sad'],
        ],
        'singapore' => [
            ['slug' => 'singapore', 'title_ru' => 'Сингапур', 'title_en' => 'Singapore'],
        ],
        'south-korea' => [
            ['slug' => 'busan', 'title_ru' => 'Пусан', 'title_en' => 'Busan'],
            ['slug' => 'daejeon', 'title_ru' => 'Тэджон', 'title_en' => 'Daejeon'],
            ['slug' => 'incheon', 'title_ru' => 'Инчхон', 'title_en' => 'Incheon'],
            ['slug' => 'seoul', 'title_ru' => 'Сеул', 'title_en' => 'Seoul'],
            ['slug' => 'suwon', 'title_ru' => 'Сувон', 'title_en' => 'Suwon'],
        ],
        'spain' => [
            ['slug' => 'barcelona', 'title_ru' => 'Барселона', 'title_en' => 'Barcelona'],
        ],
        'turkey' => [
            ['slug' => 'istanbul', 'title_ru' => 'Стамбул', 'title_en' => 'Istanbul'],
        ],
    ];

    public function run()
    {
        foreach (self::CITIES_BY_COUNTRY as $countrySlug => $cities) {
            $country = Country::query()->firstWhere('slug', $countrySlug);

            array_map(function (array $data) use ($country) {
                $city = CityFactory::new()->withCountryId($country->id)->make();
                $city->slug = $data['slug'];
                $city->title_en = $data['title_en'];
                $city->title_ru = $data['title_ru'];
                $city->save();
            }, $cities);
        }
    }
}
