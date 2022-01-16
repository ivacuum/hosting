<?php namespace App\Seeder;

use App\City;
use App\Domain\TripStatus;
use App\Factory\TripFactory;
use App\Factory\UserFactory;
use App\Trip;
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

        /** @var Trip $trip */
        $trip = Trip::where('status', TripStatus::Published)
            ->orderByDesc('date_start')
            ->first();
        $trip->status = TripStatus::Inactive;
        $trip->save();

        $trip = Trip::where('status', TripStatus::Published)
            ->orderByDesc('date_start')
            ->first();
        $trip->status = TripStatus::Hidden;
        $trip->save();

        $user = UserFactory::new()
            ->withEmail('trip@example.com')
            ->withLogin('trip')
            ->create();

        /** @var City $randomCity */
        $randomCity = City::inRandomOrder()->first();

        TripFactory::new()
            ->withCityId($randomCity->id)
            ->withUserId($user->id)
            ->create();
    }

    private function metaImage(string $slug): string
    {
        return match ($slug) {
            'berlin.2017.05' => 'IMG_0494.jpg',
            'berlin.2016' => 'IMG_0756.jpg',
            'prague.2017.05' => 'IMG_0119.jpg',
            'prague.2016' => 'IMG_1278.jpg',
            'prague.2015.12' => 'IMG_2043.jpg',
            'prague.2015.03' => 'IMG_1532.jpg',
            'osaka.2019.04.26' => 'IMG_9976.jpg',
            'osaka.2019.04.19' => 'IMG_9011.jpg',
            'osaka.2017.12' => 'IMG_4986.jpg',
            'osaka.2017' => 'IMG_4507.jpg',
            'tokyo.2018' => 'IMG_8376.jpg',
            'tokyo.2017.12' => 'IMG_5753.jpg',
            'tokyo.2017.04.17-20' => 'IMG_8577.jpg',
            'tokyo.2017.04.08-10' => 'IMG_3856.jpg',
            default => '',
        };
    }
}
