<?php

namespace Tests\Feature;

use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SignOutTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetDoesNotSignOutUser(): void
    {
        $this->be(UserFactory::new()->create())
            ->get('auth/logout')
            ->assertMethodNotAllowed();

        $this->assertAuthenticated();
    }

    public function testGuest(): void
    {
        $this->post('auth/logout')
            ->assertRedirect('auth/login')
            ->assertSessionHas('message', 'Для просмотра этой страницы необходимо быть зарегистрированным пользователем');

        $this->assertGuest();
    }

    public function testUser(): void
    {
        $this->be(UserFactory::new()->create())
            ->post('auth/logout')
            ->assertRedirect('/');

        $this->assertGuest();
    }
}
