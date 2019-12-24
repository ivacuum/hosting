<?php

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

            factory(App\Trip::class)->create([
                'slug' => $slug,
                'city_id' => $city->id,
                'title_en' => $city->title_en,
                'title_ru' => $city->title_ru,
            ]);
        }
    }
}
