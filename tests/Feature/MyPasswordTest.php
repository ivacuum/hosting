<?php namespace Tests\Feature;

use App;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MyPasswordTest extends TestCase
{
    use DatabaseTransactions;

    public function testEdit()
    {
        $this->be($user = factory(User::class)->create())
            ->get(action('MyPassword@edit'))
            ->assertStatus(200);
    }

    public function testSetNewPassword()
    {
        $newPassword = 'top-secret ';

        /** @var User $user */
        $this->be($user = factory(User::class)->create());

        $this->expectsEvents(App\Events\Stats\MyPasswordChanged::class);

        $this->put(action('MyPassword@update'), ['new_password' => $newPassword])
            ->assertStatus(302);

        $user->refresh();

        $this->assertTrue(\Hash::check($newPassword, $user->password));
    }

    public function testUpdatePassword()
    {
        $password = 'top-secret';
        $newPassword = 'password ';

        /** @var User $user */
        $this->be($user = factory(User::class)->create(['password' => $password]));

        $this->expectsEvents(App\Events\Stats\MyPasswordChanged::class);

        $this->put(action('MyPassword@update'), ['password' => $password, 'new_password' => $newPassword])
            ->assertStatus(302);

        $user->refresh();

        $this->assertTrue(\Hash::check($newPassword, $user->password));
    }
}
