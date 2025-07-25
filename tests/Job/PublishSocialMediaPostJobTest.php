<?php

namespace Tests\Job;

use App\Domain\Instagram\InstagramCreateMediaResponse;
use App\Domain\Instagram\InstagramPublishMediaResponse;
use App\Domain\SocialMedia\Factory\SocialMediaPostFactory;
use App\Domain\SocialMedia\Factory\SocialMediaTokenFactory;
use App\Domain\SocialMedia\Job\PublishSocialMediaPostJob;
use App\Domain\SocialMedia\SocialMediaPostStatus;
use App\Factory\UserFactory;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Client\Request;
use Tests\TestCase;

class PublishSocialMediaPostJobTest extends TestCase
{
    use DatabaseTransactions;

    public function testOk()
    {
        \Http::fake([
            ...InstagramCreateMediaResponse::fakeSuccess('container-id'),
            ...InstagramPublishMediaResponse::fakeSuccess('media-id'),
        ]);

        User::query()->findOr(1, fn () => UserFactory::new()->admin()->create());

        SocialMediaTokenFactory::new()
            ->withToken('token')
            ->create();

        $post = SocialMediaPostFactory::new()
            ->withCaption('caption')
            ->create();

        $this->assertSame(SocialMediaPostStatus::Queued, $post->status);

        $job = new PublishSocialMediaPostJob($post);
        $this->app->call($job->handle(...));

        $post->refresh();

        $this->assertSame(SocialMediaPostStatus::Published, $post->status);

        \Http::assertSent(function (Request $request) use ($post) {
            return $request->url() === 'https://graph.vacuum.name/v23.0/me/media?access_token=token'
                && $request['image_url'] === $post->photo->originalUrl()
                && $request['caption'] === 'caption';
        });

        \Http::assertSent(function (Request $request) {
            return $request->url() === 'https://graph.vacuum.name/v23.0/me/media_publish?access_token=token'
                && $request['creation_id'] === 'container-id';
        });
    }
}
