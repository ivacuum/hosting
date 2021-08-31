<?php namespace App\Services;

use Illuminate\Http\Client\Response;

class RtoGetTorTopicDataResponse
{
    /** @var \Illuminate\Support\Collection|\App\Services\RtoTopicData[] */
    private $topics;

    public function __construct(Response $response)
    {
        $json = $response->object();

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

    public function getTopic(int $id): ?RtoTopicData
    {
        return $this->topics[$id] ?? null;
    }

    public function getTopics()
    {
        return $this->topics;
    }
}
