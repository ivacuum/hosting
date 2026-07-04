<?php

namespace App\Domain\Life\Action;

class FindUnknownTagIdsAction
{
    public function __construct(private FindExistingTagIdsAction $findExistingTagIds) {}

    public function execute(array $tagIds): array
    {
        $valid = $this->findExistingTagIds->execute($tagIds);

        return array_values(array_diff($tagIds, $valid));
    }
}
