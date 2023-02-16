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
            ->assertOk();
    }

    public function testSetNewPassword()
    {
        $newPassword = 'top-secret ';

        \Event::fake(\App\Events\Stats\MyPasswordChanged::class);

        $this->be($user = UserFactory::new()->create())
            ->put('my/password', ['new_password' => $newPassword])
            ->assertStatus(302)
            ->assertSessionHasNoErrors();

        $user->refresh();

        $this->assertTrue(\Hash::check($newPassword, $user->password));

        \Event::assertDispatched(\App\Events\Stats\MyPasswordChanged::class);
    }

    public function testUpdatePassword()
    {
        $password = 'top-secret';
        $newPassword = 'password ';

        \Event::fake(\App\Events\Stats\MyPasswordChanged::class);

        $this->be($user = UserFactory::new()->withPassword($password)->create())
            ->put('my/password', ['password' => $password, 'new_password' => $newPassword])
            ->assertStatus(302)
            ->assertSessionHasNoErrors();

        $user->refresh();

        $this->assertTrue(\Hash::check($newPassword, $user->password));

        \Event::assertDispatched(\App\Events\Stats\MyPasswordChanged::class);
    }
}
