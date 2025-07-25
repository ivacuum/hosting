<?php

namespace App\Domain\SocialMedia\Action;

use App\Domain\SocialMedia\Models\SocialMediaPost;
use App\Domain\SocialMedia\SocialMediaPostStatus;
use App\User;
use Carbon\CarbonInterface;

class CalculateNextPostDateAction
{
    public function execute(User $user): CarbonInterface
    {
        $nextSlot = $this->nextSlot();

        $query = SocialMediaPost::query()
            ->whereBelongsTo($user)
            ->where('status', SocialMediaPostStatus::Queued)
            ->orderBy('published_at');

        foreach ($query->lazy() as $post) {
            if ($post->published_at->gt($nextSlot)) {
                return $nextSlot;
            }

            $nextSlot = $nextSlot->addDay();
        }

        return $nextSlot;
    }

    private function nextSlot(): CarbonInterface
    {
        $now = now();
        $nextSlot = $now->setTime(15, 0);

        if ($now->gte($nextSlot)) {
            return $nextSlot->addDay();
        }

        return $nextSlot;
    }
}
