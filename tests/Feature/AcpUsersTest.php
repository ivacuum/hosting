<?php namespace Tests\Feature;

use App\Domain\UserStatus;
use App\Factory\UserFactory;
use App\Http\Livewire\Acp\UserForm;
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
            ->assertOk()
            ->assertSeeLivewire(UserForm::class);
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

        \Livewire::test(UserForm::class, ['user' => $user])
            ->set('user.status', UserStatus::Inactive->value)
            ->set('user.email', 'livewire@example.com')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/users');

        $user->refresh();

        $this->assertSame('livewire@example.com', $user->email);
        $this->assertSame(UserStatus::Inactive->value, $user->status);
    }
}
