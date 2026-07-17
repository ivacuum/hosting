<?php

namespace Tests\Job;

use App\Domain\Instagram\InstagramCreateMediaResponse;
use App\Domain\Instagram\InstagramPublishMediaResponse;
use App\Domain\Life\Factory\PhotoFactory;
use App\Domain\SocialMedia\Factory\SocialMediaPostFactory;
use App\Domain\SocialMedia\Job\PublishSocialMediaPostJob;
use App\Domain\SocialMedia\SocialMediaPostStatus;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Sleep;
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

        $post = SocialMediaPostFactory::new()
            ->withCaption('caption')
            ->withPhoto(
                PhotoFactory::new()
                    ->withSlug('test/IMG_1234.jpg')
            )
            ->withSocialMediaToken('token')
            ->create();

        $this->assertSame(SocialMediaPostStatus::Queued, $post->status);

        $job = new PublishSocialMediaPostJob($post);
        $this->app->call($job->handle(...));

        $post->refresh();

        $this->assertSame(SocialMediaPostStatus::Published, $post->status);

        \Http::assertSent(static function (Request $request) {
            return $request->url() === 'https://graph.vacuum.name/v23.0/me/media?access_token=token'
                && $request['image_url'] === 'https://life-r2.ivacuum.org/test/IMG_1234.jpg'
                && $request['caption'] === 'caption';
        });

        \Http::assertSent(static function (Request $request) {
            return $request->url() === 'https://graph.vacuum.name/v23.0/me/media_publish?access_token=token'
                && $request['creation_id'] === 'container-id';
        });
    }

    public function testRetryOnCreateMediaFailure()
    {
        \Http::fake([
            ...InstagramCreateMediaResponse::fakeInvalidMedia(),
        ]);

        Sleep::fake();

        $post = SocialMediaPostFactory::new()
            ->withCaption('caption')
            ->withSocialMediaToken('token')
            ->create();

        $this->assertSame(SocialMediaPostStatus::Queued, $post->status);

        $job = new PublishSocialMediaPostJob($post);

        $this->expectException(\Illuminate\Http\Client\RequestException::class);

        $this->app->call($job->handle(...));
    }

    public function testRetryPublish()
    {
        $fakeMediaNotAvailableResponse = InstagramPublishMediaResponse::fakeMediaNotAvailable();
        $fakeSuccessResponse = InstagramPublishMediaResponse::fakeSuccess();
        $mediaPublishUrl = array_key_first($fakeMediaNotAvailableResponse);

        \Http::fake([
            ...InstagramCreateMediaResponse::fakeSuccess('container-id'),
            ...[
                $mediaPublishUrl => \Http::sequence()
                    ->pushResponse(array_first($fakeMediaNotAvailableResponse))
                    ->pushResponse(array_first($fakeSuccessResponse)),
            ],
        ]);

        Sleep::fake();

        $post = SocialMediaPostFactory::new()
            ->withCaption('caption')
            ->withPhoto(
                PhotoFactory::new()
                    ->withSlug('test/IMG_1234.jpg')
            )
            ->withSocialMediaToken('token')
            ->create();

        $this->assertSame(SocialMediaPostStatus::Queued, $post->status);

        $job = new PublishSocialMediaPostJob($post);
        $this->app->call($job->handle(...));

        $post->refresh();

        $this->assertSame(SocialMediaPostStatus::Published, $post->status);

        \Http::assertSentCount(3);

        \Http::assertSent(static function (Request $request) {
            return $request->url() === 'https://graph.vacuum.name/v23.0/me/media?access_token=token'
                && $request['image_url'] === 'https://life-r2.ivacuum.org/test/IMG_1234.jpg'
                && $request['caption'] === 'caption';
        });

        \Http::assertSent(static function (Request $request) {
            return $request->url() === 'https://graph.vacuum.name/v23.0/me/media_publish?access_token=token'
                && $request['creation_id'] === 'container-id';
        });
    }
}
