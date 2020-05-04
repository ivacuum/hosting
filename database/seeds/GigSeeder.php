<?php

use App\Factory\GigFactory;
use Illuminate\Database\Seeder;

class GigSeeder extends Seeder
{
    public function run()
    {
        $cityIds = App\City::pluck('id');

        // Для каждого шаблона нужно создать концерт
        foreach (App\Gig::templatesIterator() as $template) {
            $slug = str_replace('_', '.', $template->getBasename('.blade.php'));
            $artistSlug = Str::before($slug, '.');

            if (null === $artist = App\Artist::where('slug', $artistSlug)->first()) {
                continue;
            }

            $gig = GigFactory::new()
                ->withArtistId($artist->id)
                ->withCityId($cityIds->random())
                ->make();

            $gig->slug = $slug;
            $gig->title_en = $artist->title;
            $gig->title_ru = $artist->title;
            $gig->save();
        }
    }
}
