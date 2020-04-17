<?php namespace App\Services\Wanikani;

use Illuminate\Support\Collection;

class KanjiEntity
{
    private int $id;
    private int $level;
    private string $character;
    private Collection $meanings;
    private Collection $readings;
    private Collection $similarKanji;
    private Collection $componentRadicals;

    public function __construct(
        int $id,
        int $level,
        string $character,
        Collection $meanings,
        Collection $readings,
        Collection $componentRadicals,
        Collection $similarKanji
    ) {
        $this->id = $id;
        $this->level = $level;
        $this->meanings = $meanings;
        $this->readings = $readings;
        $this->character = $character;
        $this->similarKanji = $similarKanji;
        $this->componentRadicals = $componentRadicals;
    }

    public static function fromJson(int $id, object $json): self
    {
        return new self(
            $id,
            $json->level,
            $json->characters,
            collect($json->meanings)->pluck('meaning'),
            collect($json->readings),
            collect($json->component_subject_ids),
            collect($json->visually_similar_subject_ids)
        );
    }

    public function getCharacter()
    {
        return $this->character;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getImportantReading()
    {
        return $this->readings
            ->first(fn ($reading) => $reading->primary)
            ->type;
    }

    public function getKunyomi()
    {
        return $this->readings
            ->filter(fn ($reading) => $reading->type === 'kunyomi')
            ->map(fn ($reading) => $reading->reading);
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getMeanings()
    {
        return $this->meanings;
    }

    public function getNanori()
    {
        return $this->readings
            ->filter(fn ($reading) => $reading->type === 'nanori')
            ->map(fn ($reading) => $reading->reading);
    }

    public function getOnyomi()
    {
        return $this->readings
            ->filter(fn ($reading) => $reading->type === 'onyomi')
            ->map(fn ($reading) => $reading->reading);
    }

    public function getSimilarKanji()
    {
        return $this->similarKanji;
    }
}
