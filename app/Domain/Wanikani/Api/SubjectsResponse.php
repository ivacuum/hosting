<?php

namespace App\Domain\Wanikani\Api;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

class SubjectsResponse
{
    private Collection $subjects;

    public function __construct(public Response $response)
    {
        $this->subjects = $response->collect('data')
            ->map(static fn ($object) => match ($object['object']) {
                'radical' => RadicalEntity::fromArray($object['id'], $object['data']),
                'kanji' => KanjiEntity::fromArray($object['id'], $object['data']),
                'vocabulary' => VocabularyEntity::fromArray($object['id'], $object['data']),
                'kana_vocabulary' => VocabularyEntity::fromArray($object['id'], $object['data'], true),
            });
    }

    /** @return Collection<int, KanjiEntity> */
    public function getKanjis(): Collection
    {
        return $this->subjects->filter(static fn ($subject) => $subject instanceof KanjiEntity);
    }

    /** @return Collection<int, RadicalEntity> */
    public function getRadicals(): Collection
    {
        return $this->subjects->filter(static fn ($subject) => $subject instanceof RadicalEntity);
    }

    /** @return Collection<int, VocabularyEntity> */
    public function getVocabularies(): Collection
    {
        return $this->subjects->filter(static fn ($subject) => $subject instanceof VocabularyEntity);
    }
}
