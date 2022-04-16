<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        UserFactory::new()->create();

        $this->get('users')
            ->assertOk();
    }

    public function testShow()
    {
        $user = UserFactory::new()->create();

        $this->get("users/{$user->id}")
            ->assertOk();
    }

    public function testShow404ForInactive()
    {
        $user = UserFactory::new()->inactive()->create();

        $this->get("users/{$user->id}")
            ->assertStatus(404);
    }
}
