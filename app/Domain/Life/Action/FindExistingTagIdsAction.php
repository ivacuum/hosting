<?php

namespace App\Domain\Life\Action;

use App\Domain\Life\Models\Tag;

class FindExistingTagIdsAction
{
    public function execute(array $tagIds): array
    {
        return Tag::query()
            ->whereIn('id', $tagIds)
            ->pluck('id')
            ->all();
    }
}
