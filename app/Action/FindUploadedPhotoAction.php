<?php namespace App\Action;

use App\Gig;
use App\Photo;
use App\Trip;

class FindUploadedPhotoAction
{
    public function execute(int $userId, Gig|Trip $relation, string $slug): Photo|null
    {
        return Photo::firstWhere([
            'user_id' => $userId,
            'rel_type' => $relation->getMorphClass(),
            'rel_id' => $relation->id,
            'slug' => $slug,
        ]);
    }
}
