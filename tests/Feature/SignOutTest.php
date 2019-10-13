<?php namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SignOutTest extends TestCase
{
    use DatabaseTransactions;

    public function testGuest()
    {
        $this->get('auth/logout')
            ->assertRedirect('auth/login');

        $this->assertGuest();
    }

    public function testUser()
    {
        $this->be(factory(User::class)->create())
            ->get('auth/logout')
            ->assertRedirect('/');

        $this->assertGuest();
    }
}
