<?php

namespace App\Console\Commands;

use App\Domain\SocialMedia\Job\PublishSocialMediaPostJob;
use App\Domain\SocialMedia\Models\SocialMediaPost;
use App\Domain\SocialMedia\SocialMediaPostStatus;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Contracts\Console\Isolatable;

#[Signature('app:publish-social-media-posts')]
#[Description('Publish queued social media posts')]
class PublishSocialMediaPosts extends Command implements Isolatable
{
    public function handle()
    {
        $query = SocialMediaPost::query()
            ->where('status', SocialMediaPostStatus::Queued)
            ->whereNowOrPast('published_at');

        foreach ($query->lazy() as $post) {
            dispatch(new PublishSocialMediaPostJob($post));
        }

        return self::SUCCESS;
    }
}
