<?php

namespace App\Domain\Life\Mcp\Tools;

use App\Domain\Life\Models\Tag;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Title;
use Laravel\Mcp\Server\Tool;

#[Name('list-tags')]
#[Title('List Tags')]
#[Description('Returns the full controlled vocabulary of tags available for assigning to photos. Use the returned id values when calling assign_tags. The list is bilingual (title_ru / title_en).')]
class ListTagsTool extends Tool
{
    public function handle()
    {
        $tags = Tag::query()
            ->orderBy(Tag::titleField())
            ->get(['id', 'title_ru', 'title_en'])
            ->map(fn (Tag $tag) => [
                'id' => $tag->id,
                'title_ru' => $tag->title_ru,
                'title_en' => $tag->title_en,
            ]);

        return Response::structured([
            'tags' => $tags->all(),
            'total' => $tags->count(),
        ]);
    }

    public function outputSchema(JsonSchema $schema): array
    {
        return [
            'tags' => $schema->array()
                ->description('List of available tags.')
                ->items($schema->object([
                    'id' => $schema->integer()->required(),
                    'title_en' => $schema->string()->required(),
                    'title_ru' => $schema->string()->required(),
                ]))
                ->required(),
            'total' => $schema->integer()
                ->description('Total number of available tags.')
                ->required(),
        ];
    }
}
