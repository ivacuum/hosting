<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Client::class, fn (Faker\Generator $faker) => [
    'name' => $faker->name,
    'text' => '',
    'email' => $faker->safeEmail,
]);
