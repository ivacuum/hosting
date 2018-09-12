<?php

use Illuminate\Database\Seeder;

class TripsSeeder extends Seeder
{
    public function run()
    {
        // Для каждого шаблона нужно создать поездку
        foreach (App\Trip::templatesIterator() as $template) {
            $slug = str_replace('_', '.', $template->getBasename('.blade.php'));
            $city_slug = str_before($slug, '.');

            if (null === $city = App\City::where('slug', $city_slug)->first()) {
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
