<?php

use Illuminate\Database\Seeder;

class ChatMessageSeeder extends Seeder
{
    public function run()
    {
        $user = App\Factory\UserFactory::new()
            ->withEmail('chat@example.com')
            ->create();

        $factory = App\Factory\ChatMessageFactory::new()->withUserId($user->id);
        $factory->create();
        $factory->create();
        $factory->hidden()->create();
    }
}
