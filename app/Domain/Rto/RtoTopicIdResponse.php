<?php

namespace App\Domain\Rto;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

readonly class RtoTopicIdResponse
{
    public int|null $topicId;

    public function __construct(public Response $response, string $hash)
    {
        if ($error = $response->json('error')) {
            throw RtoApiException::fromError($error);
        }

        $this->topicId = $response->json("result.{$hash}");
    }

    public static function fakeInvalidHash(): PromiseInterface
    {
        return Factory::response([
            'error' => [
                'code' => 2,
                'text' => 'Invalid hash format',
            ],
        ]);
    }

    public static function fakeSuccess(string $hash, int|null $topicId): PromiseInterface
    {
        return Factory::response(['result' => [$hash => $topicId]]);
    }
}
