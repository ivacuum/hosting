<?php

namespace App\Observers;

use App\Domain\SocialMedia\Models\SocialMediaPost;
use App\Domain\SocialMedia\SocialMediaPostStatus;
use Illuminate\Support\Str;

class SocialMediaPostObserver
{
    public function saving(SocialMediaPost $post)
    {
        $this->ensureStatusTransitionIsCorrect($post);
        $this->ensureDatesAreSet($post);
        $this->maintainConsistency($post);
    }

    private function ensureDatesAreSet(SocialMediaPost $post): void
    {
        if ($post->isClean('status')) {
            return;
        }

        if ($post->status->isPublished()) {
            $post->published_at ??= now();
        }

        if ($post->status->isExcluded()) {
            $post->caption = '';
            $post->excluded_at ??= now();
            $post->published_at = null;
        }
    }

    private function ensureStatusTransitionIsCorrect(SocialMediaPost $post): void
    {
        if ($post->isClean('status')) {
            return;
        }

        $was = $post->getOriginal('status');

        if ($was === null) {
            return;
        }

        match ($was) {
            SocialMediaPostStatus::Queued => true,
            SocialMediaPostStatus::Published => throw new \DomainException('`published` is the final state of the post.'),
            SocialMediaPostStatus::Excluded => throw new \DomainException('`excluded` is the final state of the post.'),
        };
    }

    private function maintainConsistency(SocialMediaPost $post): void
    {
        $post->caption = Str::trim($post->caption);
    }
}
