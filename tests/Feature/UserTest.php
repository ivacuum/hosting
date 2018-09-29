<?php namespace Tests\Feature;

use App\News;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        factory(User::class)->create();

        $this->get(action('Users@index'))
            ->assertStatus(200);
    }

    public function testShow()
    {
        $user = factory(User::class)->create();

        $this->get(action('Users@show', $user))
            ->assertStatus(200);
    }

    public function testShow404ForInactive()
    {
        $user = factory(User::class)->create(['status' => User::STATUS_INACTIVE]);

        $this->get(action('Users@show', $user))
            ->assertStatus(404);
    }
}
