<?php namespace Tests\Feature;

use App\Http\Controllers\Auth\SignIn;
use App\Http\Controllers\Home;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SignOutTest extends TestCase
{
    use DatabaseTransactions;

    public function testGuest()
    {
        $this->get(action([SignIn::class, 'logout']))
            ->assertRedirect(action([SignIn::class, 'index']));

        $this->assertGuest();
    }

    public function testUser()
    {
        $this->be(factory(User::class)->create())
            ->get(action([SignIn::class, 'logout']))
            ->assertRedirect(action([Home::class, 'index']));

        $this->assertGuest();
    }
}
