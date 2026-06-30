<?php

namespace Tests\Feature;

use App\Domain\Life\Factory\TripFactory;
use App\Domain\Magnet\Factory\MagnetFactory;
use App\Domain\UserStatus;
use App\Factory\ChatMessageFactory;
use App\Factory\CommentFactory;
use App\Factory\EmailFactory;
use App\Factory\ExternalIdentityFactory;
use App\Factory\ImageFactory;
use App\Factory\NewsFactory;
use App\Factory\UserFactory;
use App\Livewire\Acp\UserForm;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpUsersTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testDestroy()
    {
        $user = UserFactory::new()->create();

        ChatMessageFactory::new()->withUser($user)->create();
        CommentFactory::new()->withUser($user)->create();
        ExternalIdentityFactory::new()->withUser($user)->create();
        ImageFactory::new()->withUser($user)->create();
        MagnetFactory::new()->withUser($user)->create();
        NewsFactory::new()->withUser($user)->create();
        TripFactory::new()->withUser($user)->create();

        EmailFactory::new()->withUser($user)->withTripPublished()->create();
        EmailFactory::new()->withUser($user)->withTemplate('SubscriptionConfirmMail')->create();

        $this->delete("acp/users/{$user->id}")
            ->assertOk();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertDatabaseMissing('chat_messages', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('comments', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('external_identities', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('images', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('magnets', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('news', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('trips', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('emails', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('emails', [
            'rel_type' => new User()->getMorphClass(),
            'rel_id' => $user->id,
        ]);
    }

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
