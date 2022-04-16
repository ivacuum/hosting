<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use DatabaseTransactions;

    public function testFormGuest()
    {
        $this->get('auth/password/remind')
            ->assertOk();

        $this->assertGuest();
    }

    public function testFormUser()
    {
        $this->be(UserFactory::new()->make())
            ->get('auth/password/remind')
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertAuthenticated();
    }

    public function testSubmitGuest()
    {
        $user = UserFactory::new()->create();

        $this->from('auth/password/remind')
            ->post('auth/password/remind', ['email' => $user->email])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('message')
            ->assertRedirect('auth/password/remind');

        $this->assertGuest();
    }
}
