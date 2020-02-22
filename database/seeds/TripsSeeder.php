<?php

use App\Factory\TripFactory;
use Illuminate\Database\Seeder;

class TripsSeeder extends Seeder
{
    public function run()
    {
        // Для каждого шаблона нужно создать поездку
        foreach (App\TripFactory::templatesIterator() as $template) {
            $slug = str_replace('_', '.', $template->getBasename('.blade.php'));
            $citySlug = Str::before($slug, '.');

            /** @var App\City $city */
            if (null === $city = App\City::where('slug', $citySlug)->first()) {
                continue;
            }

            $trip = TripFactory::new()->withCityId($city->id)->make();
            $trip->slug = $slug;
            $trip->title_en = $city->title_en;
            $trip->title_ru = $city->title_ru;
            $trip->save();
        }
    }
}
