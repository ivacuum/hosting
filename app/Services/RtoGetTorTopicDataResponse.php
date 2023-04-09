<?php namespace App\Services;

use Illuminate\Http\Client\Response;

class RtoGetTorTopicDataResponse
{
    /** @var \Illuminate\Support\Collection|\App\Services\RtoTopicData[] */
    public $topics;

    public function __construct(Response $response)
    {
        $this->topics = $response->collect('result')
            // Почему-то стали попадаться элементы вида "hash" => topic_id
            // Отфильтровываем их
            ->reject(fn ($object) => is_int($object))
            ->map(function ($payload, $topicId) {
                return $payload !== null
                    ? RtoTopicData::fromArray($topicId, $payload)
                    : null;
            });
    }

    public function getTopic(int $id): RtoTopicData|null
    {
        return $this->topics[$id] ?? null;
    }
}
