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
            ->assertStatus(200);
    }

    public function testUpdateEmail()
    {
        $user = UserFactory::new()->create();
        $email = "__{$user->email}";

        $this->be($user)
            ->expectsEvents(\App\Events\Stats\MyProfileChanged::class)
            ->put('my/profile', [
                'email' => $email,
                'username' => $user->login,
            ])
            ->assertStatus(302);

        $user->refresh();

        $this->assertEquals($email, $user->email);
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

        $this->assertEquals($login, $user->login);
    }
}
