<?php namespace App\Seeder;

use App\Action\FindGigTemplatesAction;
use App\Artist;
use App\City;
use App\Factory\GigFactory;
use Illuminate\Database\Seeder;

class GigSeeder extends Seeder
{
    public function __construct(private FindGigTemplatesAction $findGigTemplates)
    {
    }

    public function run()
    {
        $cityIds = City::pluck('id');

        // Для каждого шаблона нужно создать концерт
        foreach ($this->findGigTemplates->execute() as $template) {
            $slug = str_replace('_', '.', $template->getBasename('.blade.php'));
            $artistSlug = str($slug)->before('.');

            if (null === $artist = Artist::firstWhere('slug', $artistSlug)) {
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
