<?php namespace Tests\Feature;

use App\Http\Controllers\Auth\ResetPassword;
use App\Http\Controllers\Home;
use App\User;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use DatabaseTransactions;

    public function testFormGuest()
    {
        $this->get(action([ResetPassword::class, 'index'], ['token']))
            ->assertStatus(200);

        $this->assertGuest();
    }

    public function testFormUser()
    {
        $this->be(factory(User::class)->state('id')->make())
            ->get(action([ResetPassword::class, 'index'], ['token']))
            ->assertStatus(200);

        $this->assertAuthenticated();
    }

    public function testSubmitGuest()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $broker = app(PasswordBroker::class);
        $token = $broker->createToken($user);

        $this->from(action([ResetPassword::class, 'index'], [$token]))
            ->post(action([ResetPassword::class, 'reset']), [
                'email' => $user->email,
                'token' => $token,
                'password' => 'secret42',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(action([Home::class, 'index']));

        $this->assertAuthenticated();
    }

    public function testSubmitUser()
    {
        /** @var User $user */
        $this->be($user = factory(User::class)->create());

        $broker = app(PasswordBroker::class);
        $token = $broker->createToken($user);

        $this->from(action([ResetPassword::class, 'index'], [$token]))
            ->post(action([ResetPassword::class, 'reset']), [
                'email' => $user->email,
                'token' => $token,
                'password' => 'secret42',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(action([Home::class, 'index']));

        $this->assertAuthenticated();
    }
}
