<?php

namespace App\Seeder;

use App\Factory\PhotoFactory;
use App\Factory\TagFactory;
use App\Trip;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    public function run()
    {
        $this->seedMoscow();
        $this->seedSuwon();
    }

    private function seedMoscow()
    {
        /** @var Trip $trip */
        $trip = Trip::where('slug', 'msk.2019.09.29')->firstOrFail();

        $factory = PhotoFactory::new()->withTripId($trip->id);
        $factory->withSlug('msk.2019.09.29/IMG_1345.jpg')->create();
        $factory->withSlug('msk.2019.09.29/IMG_1346.jpg')->create();
        $factory->hidden()->withSlug('msk.2019.09.29/IMG_1347.jpg')->create();
    }

    private function seedSuwon()
    {
        /** @var Trip $trip */
        $trip = Trip::where('slug', 'suwon.2019')->firstOrFail();

        $factory = PhotoFactory::new()->withTripId($trip->id);
        $factory->withSlug('suwon.2019/IMG_4277.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4278.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4283.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4285.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4287.jpg')->withTag(TagFactory::new()->withTitle('местная надпись', 'local writing'))->create();
        $factory->withSlug('suwon.2019/IMG_4288.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4291.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4293.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4294.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4296.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4298.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4299.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4304.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4329.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4330.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4332.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4333.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4336.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4337.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4338.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4341.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4342.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4343.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4345.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4347.jpg')->create();
        $factory->withSlug('suwon.2019/IMG_4348.jpg')->create();
    }
}
