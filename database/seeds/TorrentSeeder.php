<?php

use Illuminate\Database\Seeder;

class TorrentSeeder extends Seeder
{
    public function run()
    {
        $user = App\Factory\UserFactory::new()
            ->withEmail('magnet@example.com')
            ->withLogin('magnet')
            ->create();

        $factory = App\Factory\TorrentFactory::new()->withUserId($user->id);
        $factory->advancedTitle()->create();
        $factory->advancedTitle()->create();
        $factory->advancedTitle()->create();
        $factory->advancedTitle()->create();
        $factory->advancedTitle()->withComment()->create();
        $factory->advancedTitle()->hidden()->create();
        $factory->advancedTitle()->deleted()->create();
    }
}
