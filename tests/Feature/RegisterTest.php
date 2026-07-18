<?php

namespace Tests\Feature;

use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    public function testFormGuest()
    {
        $this->get('auth/register')
            ->assertOk();

        $this->assertGuest();
    }

    public function testFormUser()
    {
        $this->be(UserFactory::new()->make())
            ->get('auth/register')
            ->assertRedirect('/');

        $this->assertAuthenticated();
    }

    public function testMultipleUsersCanRegisterWithoutLogin()
    {
        $this->post('auth/register', [
            'email' => 'first-phpunit@example.com',
            'password' => 'secret42',
        ])->assertRedirect('/');

        $this->get('auth/logout');

        $this->post('auth/register', [
            'email' => 'second-phpunit@example.com',
            'password' => 'secret42',
        ])->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'email' => 'first-phpunit@example.com',
            'login' => null,
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'second-phpunit@example.com',
            'login' => null,
        ]);
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
