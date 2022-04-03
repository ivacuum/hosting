<?php namespace App\Services\Wanikani;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

class SubjectsResponse
{
    private Collection $subjects;

    public function __construct(Response $response)
    {
        $this->subjects = $response->collect('data')
            ->map(function ($object) {
                return match ($object['object']) {
                    'radical' => RadicalEntity::fromArray($object['id'], $object['data']),
                    'kanji' => KanjiEntity::fromArray($object['id'], $object['data']),
                    'vocabulary' => VocabularyEntity::fromArray($object['id'], $object['data']),
                };
            });
    }

    /**
     * @return KanjiEntity[]|Collection
     */
    public function getKanjis()
    {
        return $this->subjects->filter(fn ($subject) => $subject instanceof KanjiEntity);
    }

    /**
     * @return RadicalEntity[]|Collection
     */
    public function getRadicals()
    {
        return $this->subjects->filter(fn ($subject) => $subject instanceof RadicalEntity);
    }

    /**
     * @return VocabularyEntity[]|Collection
     */
    public function getVocabularies()
    {
        return $this->subjects->filter(fn ($subject) => $subject instanceof VocabularyEntity);
    }
}
