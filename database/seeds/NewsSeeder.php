<?php

use App\Factory\NewsFactory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    private const COUNT = 15;

    public function run()
    {
        $userIds = App\User::pluck('id');

        for ($i = 0; $i < self::COUNT; $i++) {
            NewsFactory::new()
                ->withUserId($userIds->random())
                ->create();
        }
    }
}
