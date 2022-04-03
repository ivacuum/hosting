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

        $this->hitman($user->id);
    }

    private function hitman(int $userId)
    {
        $factory = MagnetFactory::new()
            ->withRelatedQuery('hitman')
            ->withUserId($userId);

        $factory->withTitle('Hitman: GOTY Edition [P] [RUS / ENG] (2016) (1.10.2 + 22 DLC)')->create();
        $factory->withTitle('Hitman 2 [P] [RUS + ENG] (2018)')->create();
        $factory->withTitle('Hitman 3 [P] [RUS + ENG + 4] (2021)')->create();
    }
}
