<?php namespace App\Services\Wanikani;

use Illuminate\Support\Collection;

class RadicalEntity
{
    private int $id;
    private int $level;
    private string $imageUrl;
    private string $meaning;
    private string $character;
    private Collection $foundInKanji;

    public function __construct(int $id, int $level, string $character, string $imageUrl, string $meaning, Collection $foundInKanji)
    {
        $this->id = $id;
        $this->level = $level;
        $this->meaning = $meaning;
        $this->imageUrl = $imageUrl;
        $this->character = $character;
        $this->foundInKanji = $foundInKanji;
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

    public function getCharacter()
    {
        return $this->character;
    }

    public function getFoundInKanji()
    {
        return $this->foundInKanji;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getMeaning()
    {
        return mb_strtolower($this->meaning);
    }
}
