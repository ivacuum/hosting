<?php namespace Tests\Feature;

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

        $this->be($user)
            ->expectsEvents(\App\Events\Stats\MyProfileChanged::class)
            ->put('my/profile', [
                'email' => $email,
            ])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame($email, $user->email);
        $this->assertSame('', $user->login);
    }

    public function testUpdateLogin()
    {
        $user = UserFactory::new()->create();
        $login = $user->login . $user->login;

        $this->be($user)
            ->expectsEvents(\App\Events\Stats\MyProfileChanged::class)
            ->put('my/profile', [
                'email' => $user->email,
                'username' => $login,
            ])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame($login, $user->login);
    }
}
