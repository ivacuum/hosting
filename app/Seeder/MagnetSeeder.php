<?php namespace App\Seeder;

use App\Factory\MagnetFactory;
use App\Factory\UserFactory;
use Illuminate\Database\Seeder;

class MagnetSeeder extends Seeder
{
    public function run()
    {
        $user = UserFactory::new()
            ->withEmail('magnet@example.com')
            ->withLogin('magnet')
            ->create();

        $factory = MagnetFactory::new()->withUserId($user->id);
        $factory->advancedTitle()->create();
        $factory->advancedTitle()->create();
        $factory->advancedTitle()->create();
        $factory->advancedTitle()->create();
        $factory->advancedTitle()->withComment()->create();
        $factory->advancedTitle()->hidden()->create();
        $factory->advancedTitle()->deleted()->create();
    }
}
