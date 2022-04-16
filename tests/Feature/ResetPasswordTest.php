<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use DatabaseTransactions;

    public function testFormGuest()
    {
        $this->get('auth/password/reset/token')
            ->assertOk();

        $this->assertGuest();
    }

    public function testFormUser()
    {
        $this->be(UserFactory::new()->withId(1)->make())
            ->get('auth/password/reset/token')
            ->assertOk();

        $this->assertAuthenticated();
    }

    public function testSubmitGuest()
    {
        $user = UserFactory::new()->create();
        $broker = app(PasswordBroker::class);
        $token = $broker->createToken($user);

        $this->from("auth/password/reset/{$token}")
            ->post('auth/password/reset', [
                'email' => $user->email,
                'token' => $token,
                'password' => 'secret42',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertAuthenticated();
    }

    public function testSubmitUser()
    {
        $this->be($user = UserFactory::new()->create());

        $broker = app(PasswordBroker::class);
        $token = $broker->createToken($user);

        $this->from("auth/password/reset/{$token}")
            ->post('auth/password/reset', [
                'email' => $user->email,
                'token' => $token,
                'password' => 'secret42',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertAuthenticated();
    }
}
