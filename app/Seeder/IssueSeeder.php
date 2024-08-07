<?php

namespace App\Seeder;

use App\Factory\CommentFactory;
use App\Factory\IssueFactory;
use App\Factory\UserFactory;
use App\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        $this->english();
        $this->russian();
    }

    private function english()
    {
        IssueFactory::new()
            ->closed()
            ->withTitle('Checking one-two-three, testicles, check!')
            ->withText('It seems to be working just fine.')
            ->withUser(User::query()->find(1))
            ->create();

        $user = UserFactory::new()
            ->english()
            ->withEmail('issue-en@example.com')
            ->create();

        IssueFactory::new()
            ->withTitle('Greeting from Finland—not spam, 100% verified')
            ->withText('We would like to invite you to visit our country again some day!')
            ->withUser($user)
            ->create();
    }

    private function russian()
    {
        $user = UserFactory::new()
            ->withEmail('issue-ru@example.com')
            ->create();

        IssueFactory::new()
            ->withTitle('Напишите мне письмо')
            ->withText("Очень хочется проверить работает ли мой почтовый ящик.\n\nЯ его только зарегистрировал.")
            ->withUser($user)
            ->create();

        IssueFactory::new()
            ->closed()
            ->withComment(CommentFactory::new()->withText('Так и задумано.')->withUserId(1))
            ->withTitle('Поездки на главной')
            ->withText('Истории выводятся все время случайные. Меня картинка привлекла, а я обновил страницу, и она пропала.')
            ->withUser($user)
            ->create();
    }
}
