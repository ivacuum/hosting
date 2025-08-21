<?php

namespace App\Domain\Life\Action;

use App\Domain\Life\Models\Gig;
use App\Domain\Life\Models\Photo;
use App\Domain\Life\Models\Trip;

class FindUploadedPhotoAction
{
    public function execute(int $userId, Gig|Trip $relation, string $basename): Photo|null
    {
        return Photo::query()
            ->firstWhere([
                'user_id' => $userId,
                'rel_type' => $relation->getMorphClass(),
                'rel_id' => $relation->id,
                'slug' => "{$relation->slug}/{$basename}",
            ]);
    }
}
