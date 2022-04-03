<?php namespace App\Services\Wanikani;

use Illuminate\Support\Collection;

class KanjiEntity
{
    public function __construct(
        public int $id,
        public int $level,
        public string $character,
        public Collection $meanings,
        private Collection $readings,
        private Collection $componentRadicals,
        public Collection $similarKanji
    ) {
    }

    public static function fromArray(int $id, array $json): self
    {
        return new self(
            $id,
            $json['level'],
            $json['characters'],
            collect($json['meanings'])->pluck('meaning'),
            collect($json['readings']),
            collect($json['component_subject_ids']),
            collect($json['visually_similar_subject_ids'])
        );
    }

    public function getImportantReading()
    {
        return $this->readings
            ->first(fn ($reading) => $reading['primary'])['type'];
    }

    public function getKunyomi()
    {
        return $this->readings
            ->filter(fn ($reading) => $reading['type'] === 'kunyomi')
            ->map(fn ($reading) => $reading['reading']);
    }

    public function getNanori()
    {
        return $this->readings
            ->filter(fn ($reading) => $reading['type'] === 'nanori')
            ->map(fn ($reading) => $reading['reading']);
    }

    public function getOnyomi()
    {
        return $this->readings
            ->filter(fn ($reading) => $reading['type'] === 'onyomi')
            ->map(fn ($reading) => $reading['reading']);
    }
}
