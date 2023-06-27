<?php

namespace App\Seeder;

use App\Factory\ExternalIdentityFactory;
use App\Factory\UserFactory;
use Illuminate\Database\Seeder;

class ExternalIdentitySeeder extends Seeder
{
    public function run()
    {
        $user = UserFactory::new()
            ->withEmail('social@example.com')
            ->withLogin('social')
            ->create();

        $factory = ExternalIdentityFactory::new()
            ->withEmail($user->email)
            ->withUserId($user->id);

        $factory->facebook()->create();
        $factory->github()->create();
        $factory->google()->create();
        $factory->twitter()->create();
        $factory->vk()->create();
        $factory->yandex()->create();
    }
}
