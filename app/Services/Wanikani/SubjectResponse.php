<?php namespace App\Services\Wanikani;

use Illuminate\Http\Client\Response;

class SubjectResponse
{
    public $json;
    public KanjiEntity|RadicalEntity|VocabularyEntity $subject;

    public function __construct(Response $response)
    {
        $this->json = $json = $response->object();

        $this->subject = match ($json->object) {
            'radical' => RadicalEntity::fromJson($json->id, $json->data),
            'kanji' => KanjiEntity::fromJson($json->id, $json->data),
            'vocabulary' => VocabularyEntity::fromJson($json->id, $json->data),
            default => throw new \InvalidArgumentException("Unexpected object [{$json->object}]."),
        };
    }
}
