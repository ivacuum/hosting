<?php

namespace App\Seeder;

use App\Factory\ChatMessageFactory;
use App\Factory\UserFactory;
use Illuminate\Database\Seeder;

class ChatMessageSeeder extends Seeder
{
    public function run(): void
    {
        ChatMessageFactory::new()
            ->withText('싸이 올나잇스탠드 2019')
            ->withUser(1)
            ->withCreatedAt(now()->setDate(2019, 12, 22)->setTime(23, 42))
            ->create();

        ChatMessageFactory::new()
            ->withText('Поздравляю всех с новым годом! В этом весьма коротком сообщении хочу _подчеркнуть_ что-нибудь и как-нибудь **выделить**. Спасибо за внимание! Берегите себя 🙌')
            ->withUser(1)
            ->withCreatedAt(now()->startOfYear())
            ->create();

        $user = UserFactory::new()
            ->withEmail('chat@example.com')
            ->withLogin('chat')
            ->create();

        $factory = ChatMessageFactory::new()->withUser($user);
        $factory->withText('Всем привет')->create();
        $factory->withText('Всем пока')->create();
        $factory->withText('🌚')->create();
        $factory->hidden()->withText('Неопубликованное сообщение')->create();
    }
}
