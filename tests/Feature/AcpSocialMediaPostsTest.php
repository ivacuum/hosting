<?php

namespace Tests\Feature;

use App\Domain\Life\Factory\PhotoFactory;
use App\Domain\SocialMedia\Action\PickRandomPhotoAction;
use App\Domain\SocialMedia\Factory\SocialMediaPostFactory;
use App\Domain\SocialMedia\Models\SocialMediaPost;
use App\Domain\SocialMedia\SocialMediaPostStatus;
use App\Livewire\Acp\SocialMediaPostForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpSocialMediaPostsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testCreate()
    {
        PhotoFactory::new()->withTrip()->create();

        $this->get('acp/social-media-posts/create')
            ->assertOk()
            ->assertSeeLivewire(SocialMediaPostForm::class);
    }

    public function testEdit()
    {
        $post = SocialMediaPostFactory::new()->create();

        $this->get("acp/social-media-posts/{$post->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(SocialMediaPostForm::class);
    }

    public function testIndex()
    {
        SocialMediaPostFactory::new()->create();
        SocialMediaPostFactory::new()->create();

        $this->get('acp/social-media-posts')
            ->assertOk();
    }

    public function testShow()
    {
        $post = SocialMediaPostFactory::new()->create();

        $this->get("acp/social-media-posts/{$post->id}")
            ->assertOk();
    }

    public function testStoreExcluded()
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->mock(PickRandomPhotoAction::class)
            ->expects('execute')
            ->andReturn($photo);

        \Livewire::test(SocialMediaPostForm::class)
            ->set('caption', 'phpunit caption')
            ->set('status', SocialMediaPostStatus::Excluded)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/social-media-posts/create');

        $post = SocialMediaPost::query()
            ->firstWhere(['photo_id' => $photo->id]);

        $this->assertSame('', $post->caption);
        $this->assertSame(SocialMediaPostStatus::Excluded, $post->status);
        $this->assertNull($post->published_at);
        $this->assertNotNull($post->excluded_at);
    }

    public function testStoreQueued()
    {
        PhotoFactory::new()->withTrip()->create();

        \Livewire::test(SocialMediaPostForm::class)
            ->set('caption', 'phpunit caption')
            ->set('status', SocialMediaPostStatus::Queued)
            ->set('publishedAt', '2099-12-31T00:00')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/social-media-posts/create');

        $this->get('acp/social-media-posts')
            ->assertSee('phpunit caption');

        $post = SocialMediaPost::query()
            ->firstWhere(['caption' => 'phpunit caption']);

        $this->assertSame(SocialMediaPostStatus::Queued, $post->status);
        $this->assertSame('2099-12-31T00:00:00', $post->published_at->toDateTimeLocalString());
        $this->assertNull($post->excluded_at);
    }

    public function testUpdate()
    {
        $post = SocialMediaPostFactory::new()
            ->withCaption('phpunit before')
            ->create();

        \Livewire::test(SocialMediaPostForm::class, ['id' => $post->id])
            ->set('caption', 'phpunit after')
            ->set('status', SocialMediaPostStatus::Excluded)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/social-media-posts');

        $post->refresh();

        $this->assertSame('', $post->caption);
        $this->assertSame(SocialMediaPostStatus::Excluded, $post->status);
        $this->assertNotNull($post->excluded_at);
        $this->assertNull($post->published_at);
    }
}
