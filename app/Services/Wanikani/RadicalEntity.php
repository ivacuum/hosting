<?php namespace App\Services\Wanikani;

use Illuminate\Support\Collection;

class RadicalEntity
{
    public function __construct(
        public int $id,
        public int $level,
        public string $character,
        public string $imageUrl,
        public string $meaning,
        public Collection $foundInKanji
    ) {
    }

    public static function fromJson(int $id, object $json)
    {
        $svgUrl = collect($json->character_images)
            ->first(fn ($image) => $image->content_type === 'image/svg+xml' && !$image->metadata->inline_styles)
            ->url ?? '';

        return new self(
            $id,
            $json->level,
            $json->characters ?? '',
            $svgUrl,
            collect($json->meanings)->first()->meaning,
            collect($json->amalgamation_subject_ids)
        );
    }
}
