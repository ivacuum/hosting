<?php namespace Tests\Feature;

use App\Http\Controllers\MyProfile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MyProfileTest extends TestCase
{
    use DatabaseTransactions;

    public function testEdit()
    {
        $this->be(factory(User::class)->create())
            ->get(action([MyProfile::class, 'edit']))
            ->assertStatus(200);
    }

    public function testUpdateEmail()
    {
        /** @var User $user */
        $this->be($user = factory(User::class)->create());

        $email = "__{$user->email}";

        $this->expectsEvents(\App\Events\Stats\MyProfileChanged::class);

        $this->put(action([MyProfile::class, 'update']), [
            'email' => $email,
            'username' => $user->login,
        ])
            ->assertStatus(302);

        $user->refresh();

        $this->assertEquals($email, $user->email);
    }

    public function testUpdateLogin()
    {
        /** @var User $user */
        $this->be($user = factory(User::class)->create());

        $login = $user->login . $user->login;

        $this->expectsEvents(\App\Events\Stats\MyProfileChanged::class);

        $this->put(action([MyProfile::class, 'update']), [
            'email' => $user->email,
            'username' => $login,
        ])
            ->assertStatus(302);

        $user->refresh();

        $this->assertEquals($login, $user->login);
    }
}
