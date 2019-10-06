<?php namespace Tests\Feature;

use App\Http\Controllers\Auth\NewAccount;
use App\Http\Controllers\Home;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    public function testFormGuest()
    {
        $this->get(action([NewAccount::class, 'index']))
            ->assertStatus(200);

        $this->assertGuest();
    }

    public function testFormUser()
    {
        $this->be(factory(User::class)->make())
            ->get(action([NewAccount::class, 'index']))
            ->assertRedirect(action([Home::class, 'index']));

        $this->assertAuthenticated();
    }

    public function testSubmitGuest()
    {
        $this->from(action([NewAccount::class, 'index']))
            ->post(action([NewAccount::class, 'register']), [
                'email' => 'phpunit@example.com',
                'password' => 'secret42',
            ])
            ->assertRedirect(action([Home::class, 'index']));

        $this->assertAuthenticated();
    }
}
