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
        $this->be($user = factory(User::class)->create());

        $this->get(action('MyPassword@edit'))
            ->assertStatus(200);
    }

    public function testSetNewPassword()
    {
        $new_password = 'top-secret ';

        /* @var User $user */
        $this->be($user = factory(User::class)->create());

        $this->expectsEvents(App\Events\Stats\MyPasswordChanged::class);

        $this->put(action('MyPassword@update'), compact('new_password'))
            ->assertStatus(302);

        $user->refresh();

        $this->assertTrue(\Hash::check($new_password, $user->password));
    }

    public function testUpdatePassword()
    {
        $password = 'top-secret';
        $new_password = 'password ';

        /* @var User $user */
        $this->be($user = factory(User::class)->create(compact('password')));

        $this->expectsEvents(App\Events\Stats\MyPasswordChanged::class);

        $this->put(action('MyPassword@update'), compact('password', 'new_password'))
            ->assertStatus(302);

        $user->refresh();

        $this->assertTrue(\Hash::check($new_password, $user->password));
    }
}
