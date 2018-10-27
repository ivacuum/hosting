<?php

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Gig::class, function (Faker\Generator $faker) {
    $title = "{$faker->word} {$faker->numberBetween(2000, 3000)}";

    return [
        'date' => Illuminate\Support\Carbon::instance($faker->dateTimeBetween('-4 years'))->startOfDay(),
        'slug' => str_slug($title),
        'views' => $faker->optional(0.9, 0)->numberBetween(1, 10000),
        'status' => App\Gig::STATUS_PUBLISHED,
        'title_ru' => $title,
        'title_en' => $title,

        'artist_id' => function () {
            return factory(App\Artist::class)->create()->id;
        }
    ];
});

$factory->state(App\Gig::class, 'city', function () {
    return [
        'city_id' => function () {
            return factory(App\City::class)->state('country')->create()->id;
        }
    ];
});
