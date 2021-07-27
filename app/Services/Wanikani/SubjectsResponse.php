<?php namespace App\Services\Wanikani;

use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;

class SubjectsResponse
{
    private Collection $subjects;

    public function __construct(ResponseInterface $response)
    {
        $json = json_decode((string) $response->getBody());

        $this->subjects = collect($json->data)
            ->map(function ($object) {
                return match ($object->object) {
                    'radical' => RadicalEntity::fromJson($object->id, $object->data),
                    'kanji' => KanjiEntity::fromJson($object->id, $object->data),
                    'vocabulary' => VocabularyEntity::fromJson($object->id, $object->data),
                    default => throw new \InvalidArgumentException("Unexpected object [{$object->object}]."),
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
