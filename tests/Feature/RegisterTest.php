<?php namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    public function testFormGuest()
    {
        $this->get('auth/register')
            ->assertStatus(200);

        $this->assertGuest();
    }

    public function testFormUser()
    {
        $this->be(factory(User::class)->make())
            ->get('auth/register')
            ->assertRedirect('/');

        $this->assertAuthenticated();
    }

    public function testSubmitGuest()
    {
        $this->from('auth/register')
            ->post('auth/register', [
                'email' => 'phpunit@example.com',
                'password' => 'secret42',
            ])
            ->assertRedirect('/');

        $this->assertAuthenticated();
    }
}
