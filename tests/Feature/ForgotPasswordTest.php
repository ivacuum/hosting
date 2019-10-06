<?php namespace Tests\Feature;

use App\Http\Controllers\Home;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use DatabaseTransactions;

    public function testFormGuest()
    {
        $this->get(action('Auth\ForgotPassword@index'))
            ->assertStatus(200);

        $this->assertGuest();
    }

    public function testFormUser()
    {
        $this->be(factory(User::class)->make())
            ->get(action('Auth\ForgotPassword@index'))
            ->assertSessionHasNoErrors()
            ->assertRedirect(action([Home::class, 'index']));

        $this->assertAuthenticated();
    }

    public function testSubmitGuest()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $this->from(action('Auth\ForgotPassword@index'))
            ->post(action('Auth\ForgotPassword@sendResetLink'), ['email' => $user->email])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('message')
            ->assertRedirect(action('Auth\ForgotPassword@index'));

        $this->assertGuest();
    }
}
