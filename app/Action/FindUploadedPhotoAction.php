<?php

namespace App\Action;

use App\Gig;
use App\Photo;
use App\Trip;

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
