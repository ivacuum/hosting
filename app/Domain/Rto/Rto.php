<?php

namespace App\Domain\Rto;

use App\Domain\Config;
use App\Domain\Log\ExternalService;
use App\Http\HttpRequest;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Uri;

readonly class Rto
{
    public function __construct(private Factory $http) {}

    public function findTopicId(int|string|null $input): int|null
    {
        if (is_numeric($input)) {
            return $input;
        }

        if ($input === null) {
            return null;
        }

        if (str_starts_with($input, 'http')) {
            if (\Str::contains($input, ['://rutracker.org', '://rutracker.net', '://rutracker.nl'])) {
                $query = Uri::of($input)->query();

                if (!$query->has('t')) {
                    return null;
                }

                return $query->integer('t');
            }
        }

        if (strlen($input) === 40) {
            return $this->topicIdByHash($input);
        }

        return null;
    }

    public function parseTopicBody(int $topicId): RtoTopicHtmlResponse
    {
        $request = new RtoTopicHtmlRequest($topicId);

        return new RtoTopicHtmlResponse($this->sendRequest($request));
    }

    public function topicDataById(int $id): RtoTopicData
    {
        $response = $this->topicDataByIds([$id])
            ->getTopic($id);

        if ($response === null) {
            throw new RtoTopicNotFoundException;
        }

        if ($response->status->isDuplicate()) {
            throw new RtoTopicDuplicateException;
        }

        return $response;
    }

    /** @param list<int> $ids */
    public function topicDataByIds(array $ids): RtoGetTorTopicDataResponse
    {
        $request = new RtoTopicDataRequest($ids);

        return new RtoGetTorTopicDataResponse($this->sendRequest($request));
    }

    public function topicIdByHash(string $hash): int|null
    {
        $request = new RtoTopicIdRequest($hash);

        return new RtoTopicIdResponse($this->sendRequest($request), $hash)
            ->topicId;
    }

    public function torrentData(int|string|null $input): RtoTorrentData|null
    {
        if (null === $topicId = $this->findTopicId($input)) {
            return null;
        }

        return new RtoTorrentData(
            $this->topicDataById($topicId),
            $this->parseTopicBody($topicId)
        );
    }

    private function http(): PendingRequest
    {
        return $this->http
            ->createPendingRequest()
            ->connectTimeout(3)
            ->timeout(app()->runningInConsole() ? 60 : 15)
            ->withAttributes(['service' => ExternalService::Rutracker])
            ->withOptions([
                RequestOptions::PROXY => Config::RtoProxy->get(),
            ]);
    }

    private function sendRequest(HttpRequest $request): Response
    {
        return $request->send($this->http())->throw();
    }
}
