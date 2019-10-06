<?php namespace Tests\Feature;

use App\Http\Controllers\Home;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    public function testFormGuest()
    {
        $this->get(action('Auth\NewAccount@index'))
            ->assertStatus(200);

        $this->assertGuest();
    }

    public function testFormUser()
    {
        $this->be(factory(User::class)->make())
            ->get(action('Auth\NewAccount@index'))
            ->assertRedirect(action([Home::class, 'index']));

        $this->assertAuthenticated();
    }

    public function testSubmitGuest()
    {
        $this->from(action('Auth\NewAccount@index'))
            ->post(action('Auth\NewAccount@register'), [
                'email' => 'phpunit@example.com',
                'password' => 'secret42',
            ])
            ->assertRedirect(action([Home::class, 'index']));

        $this->assertAuthenticated();
    }
}
