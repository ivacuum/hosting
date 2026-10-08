<?php

namespace Tests\Feature;

use App\Domain\UserStatus;
use App\Factory\UserFactory;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
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

    #[TestWith([UserStatus::Active])]
    #[TestWith([UserStatus::Inactive])]
    public function testSubmitGuest(UserStatus $status): void
    {
        $user = UserFactory::new()->withStatus($status)->withPassword('old-password')->create();
        $broker = $this->app->make(PasswordBroker::class);
        $token = $broker->createToken($user);

        $this->assertTrue(\Hash::check('old-password', $user->password));

        $this->from("auth/password/reset/{$token}")
            ->post('auth/password/reset', [
                'email' => $user->email,
                'token' => $token,
                'password' => 'new-password',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $user->refresh();

        $this->assertSame(UserStatus::Active, $user->status);
        $this->assertTrue(\Hash::check('new-password', $user->password));
        $this->assertFalse(\Hash::check('old-password', $user->password));
        $this->assertAuthenticatedAs($user);
    }

    public function testSubmitUser(): void
    {
        $this->be($user = UserFactory::new()->withPassword('old-password')->create());

        $broker = $this->app->make(PasswordBroker::class);
        $token = $broker->createToken($user);

        $this->from("auth/password/reset/{$token}")
            ->post('auth/password/reset', [
                'email' => $user->email,
                'token' => $token,
                'password' => 'new-password',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $user->refresh();

        $this->assertTrue(\Hash::check('new-password', $user->password));
        $this->assertFalse(\Hash::check('old-password', $user->password));
        $this->assertAuthenticatedAs($user);
    }
}
