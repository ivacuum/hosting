<?php namespace App\Services\Wanikani;

use Psr\Http\Message\ResponseInterface;

class SubjectResponse
{
    public $json;
    public KanjiEntity|RadicalEntity|VocabularyEntity $subject;

    public function __construct(ResponseInterface $response)
    {
        $this->json = $json = json_decode((string) $response->getBody());

        $this->subject = match ($json->object) {
            'radical' => RadicalEntity::fromJson($json->id, $json->data),
            'kanji' => KanjiEntity::fromJson($json->id, $json->data),
            'vocabulary' => VocabularyEntity::fromJson($json->id, $json->data),
            default => throw new \InvalidArgumentException("Unexpected object [{$json->object}]."),
        };
    }
}
