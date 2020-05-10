<?php namespace App\Seeder;

use App\Factory\ChatMessageFactory;
use App\Factory\UserFactory;
use Illuminate\Database\Seeder;

class ChatMessageSeeder extends Seeder
{
    public function run()
    {
        $user = UserFactory::new()
            ->withEmail('chat@example.com')
            ->withLogin('chat')
            ->create();

        $factory = ChatMessageFactory::new()->withUserId($user->id);
        $factory->create();
        $factory->create();
        $factory->hidden()->create();
    }
}
