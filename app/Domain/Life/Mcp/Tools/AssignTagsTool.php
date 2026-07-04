<?php

namespace App\Domain\Life\Mcp\Tools;

use App\Domain\Life\Action\AssignTagsToPhotoAction;
use App\Domain\Life\Action\FindUnknownTagIdsAction;
use App\Domain\Life\Models\Photo;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Title;
use Laravel\Mcp\Server\Tool;

#[Name('assign-tags')]
#[Title('Assign Tags')]
#[Description('Attaches the given tag ids to the given photo. Idempotent: tags already attached are silently skipped, and the composite key on taggable prevents duplicates. Use attach semantics — already-present tags are never removed.')]
class AssignTagsTool extends Tool
{
    public function __construct(
        private AssignTagsToPhotoAction $assignTagsToPhoto,
        private FindUnknownTagIdsAction $findUnknownTagIds,
    ) {}

    public function handle(Request $request)
    {
        $validated = $request->validate([
            'photo_id' => ['required', 'integer'],
            'tag_ids' => ['required', 'array', 'min:1'],
            'tag_ids.*' => ['required', 'integer'],
        ]);

        $photo = Photo::query()->find($validated['photo_id']);

        if ($photo === null) {
            return Response::error("Photo id {$validated['photo_id']} not found.");
        }

        $unknown = $this->findUnknownTagIds->execute($validated['tag_ids']);

        if ($unknown !== []) {
            return Response::error('Unknown tag ids: ' . implode(', ', $unknown) . '. Call list_tags first.');
        }

        $result = $this->assignTagsToPhoto->execute($photo, $validated['tag_ids']);

        return Response::structured([
            'photo_id' => $photo->id,
            'assigned' => $result['attached'],
            'already_present' => $result['skipped'],
        ]);
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'photo_id' => $schema->integer()
                ->description('The photo id from list_untagged_photos.')
                ->required(),

            'tag_ids' => $schema->array()
                ->description('Tag ids to attach. At least one is required.')
                ->items($schema->integer())
                ->required(),
        ];
    }

    public function outputSchema(JsonSchema $schema): array
    {
        return [
            'photo_id' => $schema->integer()->required(),
            'assigned' => $schema->integer()->description('Number of tags newly attached.')->required(),
            'already_present' => $schema->integer()->description('Number of tags that were already attached.')->required(),
        ];
    }
}
