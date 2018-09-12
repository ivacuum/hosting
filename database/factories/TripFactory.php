<?php

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Trip::class, function (Faker\Generator $faker) {
    $title = $faker->city;
    $date_start = Illuminate\Support\Carbon::instance($faker->dateTimeBetween('-4 years'))->startOfHour();
    $date_end = Illuminate\Support\Carbon::instance($date_start)->addDay(random_int(0, 3));

    return [
        'html' => '',
        'slug' => $title,
        'views' => $faker->optional(0.9, 0)->numberBetween(1, 10000),
        'status' => App\Trip::STATUS_PUBLISHED,
        'user_id' => 1,
        'date_end' => $date_end,
        'markdown' => '',
        'title_ru' => $title,
        'title_en' => $title,
        'date_start' => $date_start,
    ];
});
