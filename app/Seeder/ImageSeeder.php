<?php

namespace App\Seeder;

use App\Factory\ImageFactory;
use App\Factory\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class ImageSeeder extends Seeder
{
    public function run()
    {
        $user = UserFactory::new()
            ->withEmail('gallery@example.com')
            ->withLogin('gallery')
            ->create();

        $factory = ImageFactory::new()->withUser($user);

        for ($i = 0; $i < 10; $i++) {
            $image = $factory->create();

            $file = UploadedFile::fake()->image($image->slug, random_int(600, 800), random_int(400, 600));

            $image->siteThumbnail($file);
            $image->upload($file);
            $image->save();
        }

        $image = $factory->obsolete()->create();

        $file = UploadedFile::fake()->image($image->slug, random_int(600, 800), random_int(400, 600));

        $image->siteThumbnail($file);
        $image->upload($file);
        $image::withoutTimestamps(fn () => $image->save());
    }
}
