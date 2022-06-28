<?php namespace App\Seeder;

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

        $factory = ImageFactory::new()->withUserId($user->id);

        for ($i = 0; $i < 10; $i++) {
            $image = $factory->create();

            $file = UploadedFile::fake()->image($image->slug, random_int(600, 800), random_int(400, 600));

            $image->siteThumbnail($file);
            $image->upload($file);
            $image->save();
        }
    }
}
