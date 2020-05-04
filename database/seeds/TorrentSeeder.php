<?php

use Illuminate\Database\Seeder;

class TorrentSeeder extends Seeder
{
    public function run()
    {
        $user = App\Factory\UserFactory::new()
            ->withEmail('magnet@example.com')
            ->create();

        $factory = App\Factory\TorrentFactory::new()->withUserId($user->id);
        $factory->create();
        $factory->create();
        $factory->create();
        $factory->create();
        $factory->withComment()->create();
        $factory->hidden()->create();
        $factory->deleted()->create();
    }
}
