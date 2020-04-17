<?php namespace App\Services\Wanikani;

use Psr\Http\Message\ResponseInterface;

class SubjectResponse
{
    private $json;
    private $subject;

    public function __construct(ResponseInterface $response)
    {
        $this->json = $json = json_decode((string) $response->getBody());

        switch ($json->object) {
            case 'radical':
                $this->subject = RadicalEntity::fromJson($json->id, $json->data);
                break;

            case 'kanji':
                $this->subject = KanjiEntity::fromJson($json->id, $json->data);
                break;

            case 'vocabulary':
                $this->subject = VocabularyEntity::fromJson($json->id, $json->data);
                break;

            default:
                throw new \InvalidArgumentException("Unexpected object [{$json->object}].");
        }
    }

    public function getJson()
    {
        return $this->json;
    }

    /**
     * @return KanjiEntity|RadicalEntity|VocabularyEntity
     */
    public function getSubject()
    {
        return $this->subject;
    }
}
