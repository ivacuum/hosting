<?php namespace Tests\Feature;

use App\Http\Controllers\Home;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SignInTest extends TestCase
{
    use DatabaseTransactions;

    public function testFormGuest()
    {
        $this->get(action('Auth\SignIn@index'))
            ->assertStatus(200);

        $this->assertGuest();
    }

    public function testFormUser()
    {
        $this->be(factory(User::class)->make())
            ->get(action('Auth\SignIn@index'))
            ->assertSessionHasNoErrors()
            ->assertRedirect(action([Home::class, 'index']));

        $this->assertAuthenticated();
    }

    public function testSubmitGuest()
    {
        $user = factory(User::class)->create(['password' => 'secret42']);

        $this->from(action('Auth\SignIn@index'))
            ->post(action('Auth\SignIn@login'), [
                'email' => $user->email,
                'password' => 'secret42',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(action([Home::class, 'index']));

        $this->assertAuthenticated();
    }
}
