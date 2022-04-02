<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MyPasswordTest extends TestCase
{
    use DatabaseTransactions;

    public function testEdit()
    {
        $this->be(UserFactory::new()->create())
            ->get('my/password')
            ->assertStatus(200);
    }

    public function testSetNewPassword()
    {
        $newPassword = 'top-secret ';

        $this->be($user = UserFactory::new()->create())
            ->expectsEvents(\App\Events\Stats\MyPasswordChanged::class)
            ->put('my/password', ['new_password' => $newPassword])
            ->assertStatus(302)
            ->assertSessionHasNoErrors();

        $user->refresh();

        $this->assertTrue(\Hash::check($newPassword, $user->password));
    }

    public function testUpdatePassword()
    {
        $password = 'top-secret';
        $newPassword = 'password ';

        $this->be($user = UserFactory::new()->withPassword($password)->create())
            ->expectsEvents(\App\Events\Stats\MyPasswordChanged::class)
            ->put('my/password', ['password' => $password, 'new_password' => $newPassword])
            ->assertStatus(302)
            ->assertSessionHasNoErrors();

        $user->refresh();

        $this->assertTrue(\Hash::check($newPassword, $user->password));
    }
}
