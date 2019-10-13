<?php namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        factory(User::class)->create();

        $this->get('users')
            ->assertStatus(200);
    }

    public function testShow()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $this->get("users/{$user->id}")
            ->assertStatus(200);
    }

    public function testShow404ForInactive()
    {
        /** @var User $user */
        $user = factory(User::class)->create(['status' => User::STATUS_INACTIVE]);

        $this->get("users/{$user->id}")
            ->assertStatus(404);
    }
}
