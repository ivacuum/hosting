<?php

namespace App\Domain\Life\Seeder;

use App\Domain\Life\Action\FindGigTemplatesAction;
use App\Domain\Life\Factory\GigFactory;
use App\Domain\Life\Models\Artist;
use App\Domain\Life\Models\City;
use Illuminate\Database\Seeder;

class GigSeeder extends Seeder
{
    public function __construct(private FindGigTemplatesAction $findGigTemplates) {}

    public function run(): void
    {
        $cityIds = City::query()->pluck('id');

        // Для каждого шаблона нужно создать концерт
        foreach ($this->findGigTemplates->execute() as $template) {
            $slug = str($template->getBasename('.blade.php'))->replace('_', '.');
            $artistSlug = $slug->before('.');

            if (null === $artist = Artist::query()->firstWhere('slug', $artistSlug)) {
                continue;
            }

            $gig = GigFactory::new()
                ->withArtist($artist)
                ->withCity($cityIds->random())
                ->make();

            $gig->slug = $slug;
            $gig->title_en = $artist->title;
            $gig->title_ru = $artist->title;
            $gig->meta_image = $this->metaImage($slug);
            $gig->save();
        }
    }

    private function metaImage(string $slug): string
    {
        return match ($slug) {
            'linkinpark.2015' => 'https://life.ivacuum.org/gigs/linkinpark.2015.08.29.jpg',
            default => '',
        };
    }
}
