<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Domain::class, function (Faker\Generator $faker) {
    return [
        'text' => '',
        'domain' => $faker->domainName,
        'status' => $faker->boolean(85),
        'paid_till' => $faker->dateTimeBetween('-1 month', '+1 year'),
        'registered_at' => $faker->dateTimeBetween('-5 years'),
        'domain_control' => $faker->boolean(85),
    ];
});
