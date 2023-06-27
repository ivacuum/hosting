<?php

namespace App\Seeder;

use App\Factory\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        UserFactory::new()
            ->withEmail('root@example.com')
            ->withLogin('root')
            ->withPassword('top-secret')
            ->withLastLoginAt()
            ->create();

        UserFactory::new()
            ->withEmail('guest@example.com')
            ->withLogin('guest')
            ->withPassword('top-secret')
            ->withLastLoginAt(now()->subDays(5))
            ->create();

        UserFactory::new()
            ->withEmail('magnets@example.com')
            ->withLogin('magnets')
            ->withLastLoginAt(now()->subWeeks(2))
            ->create();
    }
}
