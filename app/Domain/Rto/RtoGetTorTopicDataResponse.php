<?php

namespace App\Domain\Rto;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

readonly class RtoGetTorTopicDataResponse
{
    /** @var Collection<int, RtoTopicData|null> */
    public Collection $topics;

    public function __construct(public Response $response)
    {
        if ($error = $response->json('error')) {
            throw RtoApiException::fromError($error);
        }

        $this->topics = $response->collect('result')
            // Почему-то стали попадаться элементы вида "hash" => topic_id
            // Отфильтровываем их
            ->reject(static fn ($object) => is_int($object))
            ->map(static function (array|null $payload, int $topicId): RtoTopicData|null {
                return $payload !== null
                    ? RtoTopicData::fromArray($topicId, $payload)
                    : null;
            });
    }

    public static function fakeNotFound(int $id): PromiseInterface
    {
        return Factory::response(['result' => [$id => null]]);
    }

    public static function fakeSuccess(RtoTopicData ...$topics): PromiseInterface
    {
        return Factory::response([
            'result' => collect($topics)
                ->mapWithKeys(static fn (RtoTopicData $topic): array => [$topic->id => $topic->toJson()])
                ->all(),
        ]);
    }

    public static function fakeTemporarilyUnavailable(): PromiseInterface
    {
        return Factory::response([
            'error' => [
                'code' => 1,
                'text' => 'Temporarily disabled',
            ],
        ]);
    }

    public static function fakeTooManyTopics(): PromiseInterface
    {
        return Factory::response([
            'error' => [
                'code' => 1,
                'text' => 'Param [val] is over the limit of 50 (you sent 100 values)',
            ],
        ]);
    }

    public function getTopic(int $id): RtoTopicData|null
    {
        return $this->topics[$id] ?? null;
    }
}
