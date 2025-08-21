<?php

namespace App\Domain\Life\Seeder;

use App\Domain\Life\Action\FindTripTemplatesAction;
use App\Domain\Life\Factory\TripFactory;
use App\Domain\Life\Models\City;
use App\Domain\Life\Models\Trip;
use App\Domain\Life\TripStatus;
use App\Factory\CommentFactory;
use App\Factory\UserFactory;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    public function __construct(private FindTripTemplatesAction $findTripTemplates) {}

    public function run()
    {
        // Для каждого шаблона нужно создать поездку
        foreach ($this->findTripTemplates->execute() as $template) {
            $slug = str($template->getBasename('.blade.php'))->replace('_', '.');
            $citySlug = $slug->before('.');

            if (null === $city = City::query()->firstWhere('slug', $citySlug)) {
                continue;
            }

            $trip = TripFactory::new()->withCityId($city->id)->make();
            $trip->slug = $slug;
            $trip->title_en = $city->title_en;
            $trip->title_ru = $city->title_ru;
            $trip->meta_image = $this->metaImage($slug);
            $trip->meta_description_en = $this->metaDescriptionInEnglish($slug);
            $trip->meta_description_ru = $this->metaDescriptionInRussian($slug);
            $trip->save();
        }

        $trip = Trip::query()
            ->where('status', TripStatus::Published)
            ->orderByDesc('date_start')
            ->first();
        $trip->status = TripStatus::Inactive;
        $trip->save();

        $trip = Trip::query()
            ->where('status', TripStatus::Published)
            ->orderByDesc('date_start')
            ->first();
        $trip->status = TripStatus::Hidden;
        $trip->save();

        $user = UserFactory::new()
            ->withEmail('trip@example.com')
            ->withLogin('trip')
            ->withPassword('top-secret')
            ->create();

        $randomCity = City::query()->inRandomOrder()->first();

        TripFactory::new()
            ->withComment(CommentFactory::new()->withText('С первой публикацией!')->withUserId(1))
            ->withCity($randomCity)
            ->withUserId($user->id)
            ->create();
    }

    private function metaDescriptionInEnglish(string $slug): string
    {
        return match ($slug) {
            'berlin.2017.05' => 'It is a forest!',
            default => '',
        };
    }

    private function metaDescriptionInRussian(string $slug): string
    {
        return match ($slug) {
            'berlin.2017.05' => 'Это лес!',
            default => '',
        };
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
