<?php

namespace Tests\Feature;

use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex(): void
    {
        UserFactory::new()->create();

        $this->get('users')
            ->assertOk();
    }

    public function testShow(): void
    {
        $user = UserFactory::new()->create();

        $this->get("users/{$user->id}")
            ->assertOk();
    }

    public function testShow404ForInactive(): void
    {
        $user = UserFactory::new()->inactive()->create();

        $this->get("users/{$user->id}")
            ->assertNotFound();
    }
}
