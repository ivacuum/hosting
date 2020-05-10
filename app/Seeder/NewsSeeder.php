<?php namespace App\Seeder;

use App\Factory\NewsFactory;
use App\Factory\UserFactory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    private const COUNT = 15;

    public function run()
    {
        $user = UserFactory::new()
            ->withEmail('news@example.com')
            ->withLogin('news')
            ->create();

        for ($i = 0; $i < self::COUNT; $i++) {
            NewsFactory::new()
                ->withUserId($user->id)
                ->create();
        }
    }
}
