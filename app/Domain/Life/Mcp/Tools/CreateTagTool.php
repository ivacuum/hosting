<?php

namespace App\Domain\Life\Mcp\Tools;

use App\Domain\Life\Models\Tag;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Title;
use Laravel\Mcp\Server\Tool;

#[Name('create-tag')]
#[Title('Create Tag')]
#[Description('Creates a new tag with bilingual titles. Use only when vision recognition finds a salient concept that is not present in the list_tags vocabulary. Returns the id of the created tag, which can then be passed to assign_tags. Rejects duplicates by title_ru or title_en.')]
class CreateTagTool extends Tool
{
    public function handle(Request $request)
    {
        $validated = $request->validate([
            'title_ru' => ['required', 'string', 'max:50'],
            'title_en' => ['required', 'string', 'max:50'],
        ]);

        $exists = Tag::query()
            ->where('title_ru', $validated['title_ru'])
            ->orWhere('title_en', $validated['title_en'])
            ->exists();

        if ($exists) {
            return Response::error("A tag with title_ru=\"{$validated['title_ru']}\" or title_en=\"{$validated['title_en']}\" already exists. Call list_tags to find its id.");
        }

        $tag = new Tag;
        $tag->title_en = $validated['title_en'];
        $tag->title_ru = $validated['title_ru'];
        $tag->save();

        return Response::structured([
            'id' => $tag->id,
            'title_en' => $tag->title_en,
            'title_ru' => $tag->title_ru,
        ]);
    }

    #[\Override]
    public function schema(JsonSchema $schema): array
    {
        return [
            'title_en' => $schema->string()
                ->description('English tag title.')
                ->required(),
            'title_ru' => $schema->string()
                ->description('Russian tag title.')
                ->required(),
        ];
    }

    #[\Override]
    public function outputSchema(JsonSchema $schema): array
    {
        return [
            'id' => $schema->integer()->required(),
            'title_en' => $schema->string()->required(),
            'title_ru' => $schema->string()->required(),
        ];
    }
}
