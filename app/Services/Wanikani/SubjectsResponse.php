<?php namespace App\Services\Wanikani;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

class SubjectsResponse
{
    private Collection $subjects;

    public function __construct(Response $response)
    {
        $this->subjects = $response->collect('data')
            ->map(fn ($object) => match ($object['object']) {
                'radical' => RadicalEntity::fromArray($object['id'], $object['data']),
                'kanji' => KanjiEntity::fromArray($object['id'], $object['data']),
                'vocabulary' => VocabularyEntity::fromArray($object['id'], $object['data']),
            });
    }

    /** @return Collection<int, KanjiEntity> */
    public function getKanjis()
    {
        return $this->subjects->filter(fn ($subject) => $subject instanceof KanjiEntity);
    }

    /** @return Collection<int, RadicalEntity> */
    public function getRadicals()
    {
        return $this->subjects->filter(fn ($subject) => $subject instanceof RadicalEntity);
    }

    /** @return Collection<int, VocabularyEntity> */
    public function getVocabularies()
    {
        return $this->subjects->filter(fn ($subject) => $subject instanceof VocabularyEntity);
    }
}
