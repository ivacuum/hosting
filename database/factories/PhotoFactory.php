<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Photo::class, fn (Faker\Generator $faker) => [
    'lat' => $faker->latitude,
    'lon' => $faker->longitude,
    'slug' => "test/IMG_{$faker->numberBetween(1000, 9999)}.jpg",
    'views' => $faker->optional(0.9, 0)->numberBetween(1, 10000),
    'status' => App\Photo::STATUS_PUBLISHED,
    'user_id' => 1,
]);

$factory->state(App\Photo::class, 'trip', fn () => [
    'rel_id' => factory(App\Trip::class)->states('city', 'meta_image'),
    'rel_type' => (new App\Trip)->getMorphClass(),
]);

$factory->afterCreatingState(App\Photo::class, 'tag', function (App\Photo $photo) {
    $photo->tags()->attach(factory(App\Tag::class)->create()->getKey());
});
