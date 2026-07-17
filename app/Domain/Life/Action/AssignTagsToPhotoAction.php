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

        $alreadyAttached = $photo->tags()
            ->whereIn('tags.id', $tagIds)
            ->pluck('tags.id')
            ->all();

        $newIds = array_values(array_diff($tagIds, $alreadyAttached));

        if ($newIds !== []) {
            $existing = $this->findExistingTagIds->execute($newIds);

            $photo->tags()->attach($existing);
        }

        return [
            'attached' => count($newIds),
            'skipped' => count($alreadyAttached),
        ];
    }
}
