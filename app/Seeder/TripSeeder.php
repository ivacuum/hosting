<?php namespace App\Seeder;

use App\City;
use App\Factory\TripFactory;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    public function run()
    {
        // Для каждого шаблона нужно создать поездку
        foreach (\App\TripFactory::templatesIterator() as $template) {
            $slug = str_replace('_', '.', $template->getBasename('.blade.php'));
            $citySlug = \Str::before($slug, '.');

            /** @var City $city */
            if (null === $city = City::where('slug', $citySlug)->first()) {
                continue;
            }

            $trip = TripFactory::new()->withCityId($city->id)->make();
            $trip->slug = $slug;
            $trip->title_en = $city->title_en;
            $trip->title_ru = $city->title_ru;
            $trip->meta_image = $this->metaImage($slug);
            $trip->save();
        }
    }

    private function metaImage(string $slug): string
    {
        switch ($slug) {
            case 'berlin.2017.05':
                return 'IMG_0494.jpg';
            case 'berlin.2016':
                return 'IMG_0756.jpg';

            case 'prague.2017.05':
                return 'IMG_0119.jpg';
            case 'prague.2016':
                return 'IMG_1278.jpg';
            case 'prague.2015.12':
                return 'IMG_2043.jpg';
            case 'prague.2015.03':
                return 'IMG_1532.jpg';

            case 'osaka.2019.04.26':
                return 'IMG_9976.jpg';
            case 'osaka.2019.04.19':
                return 'IMG_9011.jpg';
            case 'osaka.2017.12':
                return 'IMG_4986.jpg';
            case 'osaka.2017':
                return 'IMG_4507.jpg';

            case 'tokyo.2018':
                return 'IMG_8376.jpg';
            case 'tokyo.2017.12':
                return 'IMG_5753.jpg';
            case 'tokyo.2017.04.17-20':
                return 'IMG_8577.jpg';
            case 'tokyo.2017.04.08-10':
                return 'IMG_3856.jpg';
            default:
                return '';
        }
    }
}
