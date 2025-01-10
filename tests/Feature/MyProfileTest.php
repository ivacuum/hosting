<?php

namespace Tests\Feature;

use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MyProfileTest extends TestCase
{
    use DatabaseTransactions;

    public function testEdit()
    {
        $this->be(UserFactory::new()->create())
            ->get('my/profile')
            ->assertOk();
    }

    public function testUpdateEmail()
    {
        $user = UserFactory::new()->withLogin('')->create();
        $email = "__{$user->email}";

        \Event::fake(\App\Events\Stats\MyProfileChanged::class);

        $this->be($user)
            ->put('my/profile', [
                'email' => $email,
            ])
            ->assertFound();

        $user->refresh();

        $this->assertSame($email, $user->email);
        $this->assertSame('', $user->login);

        \Event::assertDispatched(\App\Events\Stats\MyProfileChanged::class);
    }

    public function testUpdateLogin()
    {
        $user = UserFactory::new()->withLogin('phpunit')->create();

        \Event::fake(\App\Events\Stats\MyProfileChanged::class);

        $this->be($user)
            ->put('my/profile', [
                'email' => $user->email,
                'username' => 'phpunit-phpunit',
            ])
            ->assertFound();

        $user->refresh();

        $this->assertSame('phpunit-phpunit', $user->login);

        \Event::assertDispatched(\App\Events\Stats\MyProfileChanged::class);
    }
}
