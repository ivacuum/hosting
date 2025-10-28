<?php

namespace App\Domain\SocialMedia\Job;

use App\Domain\Instagram\InstagramApi;
use App\Domain\SocialMedia\Models\SocialMediaPost;
use App\Domain\SocialMedia\SocialMediaPostStatus;
use App\Jobs\AbstractJob;
use Carbon\CarbonInterval;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Queue\Attributes\WithoutRelations;

#[WithoutRelations]
class PublishSocialMediaPostJob extends AbstractJob implements ShouldBeUnique
{
    public function __construct(public SocialMediaPost $post) {}

    public function handle(InstagramApi $instagram)
    {
        if (!$this->post->status->isQueued()) {
            return;
        }

        $containerId = $instagram
            ->createMedia(
                $this->post->user->socialMediaTokens->first()->token,
                $this->post->photo->originalUrl(),
                $this->post->caption
            )
            ->containerId;

        $instagram->publishMedia($this->post->user->socialMediaTokens->first()->token, $containerId);

        $this->post->status = SocialMediaPostStatus::Published;
        $this->post->save();
    }

    public function uniqueFor(): int
    {
        return CarbonInterval::day()->totalSeconds;
    }

    public function uniqueId()
    {
        return $this->post->id;
    }
}
