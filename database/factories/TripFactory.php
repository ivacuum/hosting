<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Trip::class, function (Faker\Generator $faker) {
    $title = "{$faker->city} {$faker->numberBetween(2000, 3000)}";
    $dateStart = Illuminate\Support\Carbon::instance($faker->dateTimeBetween('-4 years'))->startOfHour();
    $dateEnd = Illuminate\Support\Carbon::instance($dateStart)->addDays(random_int(0, 3));

    return [
        'html' => '',
        'slug' => Str::slug($title),
        'views' => $faker->optional(0.9, 0)->numberBetween(1, 10000),
        'status' => App\Trip::STATUS_PUBLISHED,
        'user_id' => 1,
        'date_end' => $dateEnd,
        'markdown' => '',
        'title_ru' => $title,
        'title_en' => $title,
        'date_start' => $dateStart,
    ];
});

$factory->state(App\Trip::class, 'city', fn () => [
    'city_id' => factory(App\City::class)->state('country'),
]);

$factory->state(App\Trip::class, 'meta_image', fn (Faker\Generator $faker) => [
    'meta_image' => "test/IMG_{$faker->numberBetween(1000, 9999)}.jpg",
]);
