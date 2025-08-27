<?php

namespace App\Console\Commands;

use App\Domain\SocialMedia\Job\PublishSocialMediaPostJob;
use App\Domain\SocialMedia\Models\SocialMediaPost;
use App\Domain\SocialMedia\SocialMediaPostStatus;
use Illuminate\Contracts\Console\Isolatable;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:publish-social-media-posts')]
class PublishSocialMediaPosts extends Command implements Isolatable
{
    protected $signature = 'app:publish-social-media-posts';

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
