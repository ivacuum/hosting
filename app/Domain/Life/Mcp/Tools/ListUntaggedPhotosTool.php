<?php

namespace App\Domain\Life\Mcp\Tools;

use App\Domain\Life\Models\Photo;
use App\Domain\Life\PhotoStatus;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Title;
use Laravel\Mcp\Server\Tool;

#[Name('list-untagged-photos')]
#[Title('List Untagged Photos')]
#[Description('Returns a paginated list of published photos that currently have no tags assigned. Use original_url to download the photo bytes for vision recognition. Iterate with page + per_page until total is exhausted.')]
class ListUntaggedPhotosTool extends Tool
{
    private const int MAX_PER_PAGE = 200;
    private const int DEFAULT_PER_PAGE = 50;

    public function handle(Request $request)
    {
        $validated = $request->validate([
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:' . self::MAX_PER_PAGE],
        ]);

        $page = (int) ($validated['page'] ?? 1);
        $perPage = (int) ($validated['per_page'] ?? self::DEFAULT_PER_PAGE);

        $paginator = Photo::query()
            ->whereDoesntHave('tags')
            ->where('status', PhotoStatus::Published)
            ->orderBy('id')
            ->simplePaginate($perPage, ['id', 'slug', 'rel_type', 'rel_id'], 'page', $page);

        $photos = $paginator->getCollection()
            ->map(fn (Photo $photo) => [
                'id' => $photo->id,
                'slug' => $photo->slug,
                'rel_type' => $photo->rel_type,
                'rel_id' => $photo->rel_id,
                'original_url' => $photo->originalR2Url(),
            ]);

        return Response::structured([
            'photos' => $photos->all(),
            'page' => $paginator->currentPage(),
            'per_page' => $perPage,
            'has_more_pages' => $paginator->hasMorePages(),
        ]);
    }

    #[\Override]
    public function schema(JsonSchema $schema): array
    {
        return [
            'page' => $schema->integer()
                ->description('Page number, 1-based.')
                ->default(1),
            'per_page' => $schema->integer()
                ->description('Number of photos per page. Max ' . self::MAX_PER_PAGE . '.')
                ->default(self::DEFAULT_PER_PAGE),
        ];
    }

    #[\Override]
    public function outputSchema(JsonSchema $schema): array
    {
        return [
            'photos' => $schema->array()
                ->description('Untagged photos on the current page.')
                ->items($schema->object([
                    'id' => $schema->integer()->required(),
                    'slug' => $schema->string()->required(),
                    'rel_type' => $schema->string()->required(),
                    'rel_id' => $schema->integer()->required(),
                    'original_url' => $schema->string()->required(),
                ]))
                ->required(),
            'page' => $schema->integer()->required(),
            'per_page' => $schema->integer()->required(),
            'has_more_pages' => $schema->boolean()->required(),
        ];
    }
}
