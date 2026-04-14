<?php

namespace App\Domain\Wanikani\Api;

use Illuminate\Support\Collection;

class KanjiEntity
{
    public function __construct(
        public int $id,
        public int $level,
        public string $character,
        public Collection $meanings,
        private Collection $readings,
        public Collection $componentRadicals,
        public Collection $similarKanji,
    ) {}

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
            ->first(static fn ($reading) => $reading['primary'])['type'];
    }

    public function getKunyomi()
    {
        return $this->readings
            ->filter(static fn ($reading) => $reading['type'] === 'kunyomi')
            ->map(static fn ($reading) => $reading['reading']);
    }

    public function getNanori()
    {
        return $this->readings
            ->filter(static fn ($reading) => $reading['type'] === 'nanori')
            ->map(static fn ($reading) => $reading['reading']);
    }

    public function getOnyomi()
    {
        return $this->readings
            ->filter(static fn ($reading) => $reading['type'] === 'onyomi')
            ->map(static fn ($reading) => $reading['reading']);
    }
}
