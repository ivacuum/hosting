<?php

namespace Tests\Feature;

use App\Domain\Life\Factory\PhotoFactory;
use App\Domain\Life\Factory\TripFactory;
use App\Domain\Magnet\Factory\MagnetFactory;
use App\Domain\SocialMedia\Factory\SocialMediaPostFactory;
use App\Domain\Telegram\Factory\LinkRequestFactory;
use App\Domain\UserStatus;
use App\Domain\Wanikani\Action\BurnAction;
use App\Domain\Wanikani\Factory\RadicalFactory;
use App\Factory\ChatMessageFactory;
use App\Factory\CommentFactory;
use App\Factory\EmailFactory;
use App\Factory\ExternalIdentityFactory;
use App\Factory\ImageFactory;
use App\Factory\IssueFactory;
use App\Factory\NewsFactory;
use App\Factory\UserFactory;
use App\Livewire\Acp\UserForm;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpUsersTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testDestroy(): void
    {
        $user = UserFactory::new()->create();

        ChatMessageFactory::new()->withUser($user)->create();
        CommentFactory::new()->withUser($user)->withNews()->create();
        ExternalIdentityFactory::new()->withUser($user)->create();
        ImageFactory::new()->withUser($user)->create();
        IssueFactory::new()->withUser($user)->create();
        LinkRequestFactory::new()->withUser($user)->create();
        MagnetFactory::new()->withUser($user)->create();
        NewsFactory::new()->withUser($user)->create();
        SocialMediaPostFactory::new()
            ->withPhoto(PhotoFactory::new()->withUser($user))
            ->withSocialMediaToken()
            ->create();
        TripFactory::new()->withUser($user)->create();

        app(BurnAction::class)->execute(RadicalFactory::new()->create(), $user->id);

        EmailFactory::new()->withUser($user)->withTripPublished()->create();
        EmailFactory::new()->withUser($user)->withTemplate('SubscriptionConfirmMail')->create();

        $this->delete("acp/users/{$user->id}")
            ->assertOk();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertDatabaseMissing('burnables', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('chat_messages', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('comments', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('external_identities', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('images', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('issues', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('link_requests', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('magnets', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('news', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('photos', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('social_media_posts', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('social_media_tokens', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('trips', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('emails', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('emails', [
            'rel_type' => new User()->getMorphClass(),
            'rel_id' => $user->id,
        ]);
    }

    public function testDestroyKeepsFilesUntilCommit(): void
    {
        $gallery = \Storage::fake('gallery');
        $photos = \Storage::fake('photos');

        $user = UserFactory::new()->create();
        $image = ImageFactory::new()->withUser($user)->create();
        $photo = PhotoFactory::new()->withUser($user)->withTrip()->create();
        $imagePath = "{$image->splitDate()}/{$image->slug}";

        $gallery->put($imagePath, 'image');
        $photos->put($photo->slug, 'photo');

        try {
            \DB::transaction(static function () use ($user) {
                $user->delete();

                throw new \RuntimeException('Deletion failed after related models were deleted');
            });
        } catch (\RuntimeException) {
        }

        $gallery->assertExists($imagePath);
        $photos->assertExists($photo->slug);

        User::query()->findOrFail($user->id)->delete();

        $gallery->assertMissing($imagePath);
        $photos->assertMissing($photo->slug);
    }

    public function testEdit(): void
    {
        $user = UserFactory::new()->create();

        $this->get("acp/users/{$user->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(UserForm::class);
    }

    public function testFilterLastLoginAt(): void
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

    public function testIndex(): void
    {
        UserFactory::new()->create();

        $this->get('acp/users')
            ->assertOk();
    }

    public function testShow(): void
    {
        $user = UserFactory::new()->create();

        $this->get("acp/users/{$user->id}")
            ->assertOk();
    }

    public function testUpdate(): void
    {
        $user = UserFactory::new()->create();

        \Livewire::test(UserForm::class, ['id' => $user->id])
            ->set('status', UserStatus::Inactive)
            ->set('email', 'livewire@example.com')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/users');

        $user->refresh();

        $this->assertSame('livewire@example.com', $user->email);
        $this->assertSame(UserStatus::Inactive, $user->status);
    }
}
