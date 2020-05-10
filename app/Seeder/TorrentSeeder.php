<?php namespace App\Seeder;

use App\Factory\TorrentFactory;
use App\Factory\UserFactory;
use Illuminate\Database\Seeder;

class TorrentSeeder extends Seeder
{
    public function run()
    {
        $user = UserFactory::new()
            ->withEmail('magnet@example.com')
            ->withLogin('magnet')
            ->create();

        $factory = TorrentFactory::new()->withUserId($user->id);
        $factory->advancedTitle()->create();
        $factory->advancedTitle()->create();
        $factory->advancedTitle()->create();
        $factory->advancedTitle()->create();
        $factory->advancedTitle()->withComment()->create();
        $factory->advancedTitle()->hidden()->create();
        $factory->advancedTitle()->deleted()->create();
    }
}
