<?php namespace Tests\Feature;

use App\Http\Controllers\Home;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SignOutTest extends TestCase
{
    use DatabaseTransactions;

    public function testGuest()
    {
        $this->get(action('Auth\SignIn@logout'))
            ->assertRedirect(action('Auth\SignIn@index'));

        $this->assertGuest();
    }

    public function testUser()
    {
        $this->be(factory(User::class)->create())
            ->get(action('Auth\SignIn@logout'))
            ->assertRedirect(action([Home::class, 'index']));

        $this->assertGuest();
    }
}
