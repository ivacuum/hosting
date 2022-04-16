<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpUsersTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

    public function testEdit()
    {
        $user = UserFactory::new()->create();

        $this->get("acp/users/{$user->id}/edit")
            ->assertOk();
    }

    public function testIndex()
    {
        UserFactory::new()->create();

        $this->get('acp/users')
            ->assertOk();
    }

    public function testShow()
    {
        $user = UserFactory::new()->create();

        $this->get("acp/users/{$user->id}")
            ->assertOk();
    }

    public function testUpdate()
    {
        $user = UserFactory::new()->create();

        $this->put("acp/users/{$user->id}", UserFactory::new()->make()->toArray())
            ->assertRedirect('acp/users');
    }
}
