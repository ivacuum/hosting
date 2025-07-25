<?php

namespace Tests\Feature;

use App\Console\Commands\PublishSocialMediaPosts;
use App\Domain\SocialMedia\Factory\SocialMediaPostFactory;
use App\Domain\SocialMedia\Job\PublishSocialMediaPostJob;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PublishSocialMediaPostsCommandTest extends TestCase
{
    use DatabaseTransactions;

    public function testQuery()
    {
        \Queue::fake();

        $excludedPost = SocialMediaPostFactory::new()
            ->excluded()
            ->create();

        $publishedPost = SocialMediaPostFactory::new()
            ->published()
            ->create();

        $queuedPost = SocialMediaPostFactory::new()
            ->create();

        $queuedOldPost = SocialMediaPostFactory::new()
            ->withPublishedAt(now()->subDay())
            ->create();

        $queuedFuturePost = SocialMediaPostFactory::new()
            ->withPublishedAt(now()->addDay())
            ->create();

        $this->artisan(PublishSocialMediaPosts::class);

        \Queue::assertCount(2);

        \Queue::assertNotPushed(
            PublishSocialMediaPostJob::class,
            fn (PublishSocialMediaPostJob $job) => $job->post->is($excludedPost)
        );

        \Queue::assertNotPushed(
            PublishSocialMediaPostJob::class,
            fn (PublishSocialMediaPostJob $job) => $job->post->is($publishedPost)
        );

        \Queue::assertNotPushed(
            PublishSocialMediaPostJob::class,
            fn (PublishSocialMediaPostJob $job) => $job->post->is($queuedFuturePost)
        );

        \Queue::assertPushed(
            PublishSocialMediaPostJob::class,
            fn (PublishSocialMediaPostJob $job) => $job->post->is($queuedPost)
        );

        \Queue::assertPushed(
            PublishSocialMediaPostJob::class,
            fn (PublishSocialMediaPostJob $job) => $job->post->is($queuedOldPost)
        );
    }
}
