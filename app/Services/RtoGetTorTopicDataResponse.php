<?php namespace App\Services;

use Psr\Http\Message\ResponseInterface;

class RtoGetTorTopicDataResponse
{
    /** @var \Illuminate\Support\Collection|\App\Services\RtoTopicData[] */
    private $topics;

    public function __construct(ResponseInterface $response)
    {
        $json = $this->responseAsJson($response);

        $collection = $json->result;

        $this->topics = collect($collection)
            // Почему-то стали попадаться элементы вида "hash" => topic_id
            // Отфильтровываем их
            ->reject(fn ($object) => is_integer($object))
            ->map(function ($object, $key) {
                return $object !== null
                    ? RtoTopicData::fromJson($key, $object)
                    : null;
            });
    }

    protected function responseAsJson(ResponseInterface $response, bool $asArray = false)
    {
        return json_decode((string) $response->getBody(), $asArray);
    }

    public function getTopic(int $id): ?RtoTopicData
    {
        return $this->topics[$id] ?? null;
    }

    public function getTopics()
    {
        return $this->topics;
    }
}
