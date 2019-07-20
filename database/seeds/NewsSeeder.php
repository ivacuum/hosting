<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    const COUNT = 15;

    public function run()
    {
        $userIds = App\User::get(['id'])->pluck('id');

        for ($i = 0; $i < self::COUNT; $i++) {
            factory(App\News::class)->create(['user_id' => $userIds->random()]);
        }
    }
}
