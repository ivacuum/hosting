<?php namespace App\Seeder;

use App\Factory\ChatMessageFactory;
use App\Factory\UserFactory;
use Illuminate\Database\Seeder;

class ChatMessageSeeder extends Seeder
{
    public function run()
    {
        ChatMessageFactory::new()
            ->withText('싸이 올나잇스탠드 2019')
            ->withUserId(1)
            ->withCreatedAt(now()->setDate(2019, 12, 22)->setTime(23, 42))
            ->create();

        ChatMessageFactory::new()
            ->withText('Поздравляю всех с новым годом! В этом весьма коротком сообщении хочу _подчеркнуть_ что-нибудь и как-нибудь **выделить**. Спасибо за внимание! Берегите себя 🙌')
            ->withUserId(1)
            ->withCreatedAt(now()->startOfYear())
            ->create();

        $user = UserFactory::new()
            ->withEmail('chat@example.com')
            ->withLogin('chat')
            ->create();

        $factory = ChatMessageFactory::new()->withUserId($user->id);
        $factory->withText('Всем привет')->create();
        $factory->withText('Всем пока')->create();
        $factory->withText('🌚')->create();
        $factory->hidden()->withText('Неопубликованное сообщение')->create();
    }
}
