<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    const COUNT = 15;

    public function run()
    {
        $user_ids = App\User::get(['id'])->pluck('id');

        for ($i = 0; $i < self::COUNT; $i++) {
            factory(App\News::class)->create(['user_id' => $user_ids->random()]);
        }
    }
}
