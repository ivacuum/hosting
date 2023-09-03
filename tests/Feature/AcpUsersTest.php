<?php

namespace Tests\Feature;

use App\Domain\UserStatus;
use App\Factory\UserFactory;
use App\Livewire\Acp\UserForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpUsersTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testEdit()
    {
        $user = UserFactory::new()->create();

        $this->get("acp/users/{$user->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(UserForm::class);
    }

    public function testFilterLastLoginAt()
    {
        $visibleUser = UserFactory::new()
            ->withLastLoginAt(now()->subDay())
            ->create();

        $invisibleUser = UserFactory::new()
            ->withLastLoginAt(now()->subYear())
            ->create();

        $this->get('acp/users?last_login_at=P2M')
            ->assertSee($visibleUser->email)
            ->assertDontSee($invisibleUser->email)
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

        \Livewire::test(UserForm::class, ['id' => $user->id])
            ->set('status', UserStatus::Inactive->value)
            ->set('email', 'livewire@example.com')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/users');

        $user->refresh();

        $this->assertSame('livewire@example.com', $user->email);
        $this->assertSame(UserStatus::Inactive->value, $user->status);
    }
}
