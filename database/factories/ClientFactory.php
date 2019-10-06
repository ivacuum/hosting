<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'text' => '',
        'email' => $faker->safeEmail,
    ];
});
