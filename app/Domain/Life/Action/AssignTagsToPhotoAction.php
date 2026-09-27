<?php

namespace App\Domain\Life\Action;

use App\Domain\Life\Models\Photo;

class AssignTagsToPhotoAction
{
    public function __construct(private FindExistingTagIdsAction $findExistingTagIds) {}

    public function execute(Photo $photo, array $tagIds): array
    {
        $tagIds = array_map(intval(...), $tagIds)
            |> array_unique(...)
            |> array_values(...);

        if ($tagIds === []) {
            return ['attached' => 0, 'skipped' => 0];
        }

        $existingTagIds = $this->findExistingTagIds->execute($tagIds);
        $changes = $photo->tags()->syncWithoutDetaching($existingTagIds);
        $attached = count($changes['attached']);

        return [
            'attached' => $attached,
            'skipped' => count($existingTagIds) - $attached,
        ];
    }
}
