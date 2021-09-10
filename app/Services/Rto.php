<?php namespace App\Services;

use GuzzleHttp\RequestOptions;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;

class Rto
{
    private const API_ENDPOINT = 'http://api.rutracker.org/v1/';
    private const SITE_ENDPOINT = 'https://rutracker.org/forum/';

    private PendingRequest $http;

    public function __construct(Factory $http)
    {
        $this->http = $http->timeout(\App::runningInConsole() ? 60 : 15);
    }

    public function findTopicId($input): ?int
    {
        if (is_numeric($input)) {
            return $input;
        }

        if ($input === null) {
            return null;
        }

        if (str_starts_with($input, 'http')) {
            if (\Str::contains($input, ['://rutracker.org', '://rutracker.net', '://rutracker.nl'])) {
                $url = parse_url($input);

                if (!isset($url['query'])) {
                    return null;
                }

                parse_str($url['query'], $args);

                if (!isset($args['t'])) {
                    return null;
                }

                return $args['t'];
            }
        }

        if (strlen($input) === 40) {
            return $this->topicIdByHash($input);
        }

        return null;
    }

    public function torrentData($input): ?RtoTorrentData
    {
        if (null === $topicId = $this->findTopicId($input)) {
            return null;
        }

        return new RtoTorrentData(
            $this->topicDataById($topicId),
            $this->parseTopicBody($topicId)
        );
    }

    public function parseTopicBody(int $topicId): RtoTopicHtmlResponse
    {
        $response = $this->http
            ->withOptions([
                RequestOptions::PROXY => env('RTO_PROXY'),
                RequestOptions::FORCE_IP_RESOLVE => \App::isProduction()
                    ? 'v6'
                    : null,
            ])
            ->get(self::SITE_ENDPOINT . "viewtopic.php?t={$topicId}");

        return new RtoTopicHtmlResponse($response->body());
    }

    public function topicDataById(int $id)
    {
        $response = $this->topicDataByIds([$id])
            ->getTopic($id);

        if ($response === null) {
            throw new RtoTopicNotFoundException;
        }

        if ($response->isDuplicate()) {
            throw new RtoTopicDuplicateException;
        }

        return $response;
    }

    public function topicDataByIds(array $ids): RtoGetTorTopicDataResponse
    {
        $response = $this->http
            ->withOptions([
                RequestOptions::FORCE_IP_RESOLVE => \App::isProduction()
                    ? 'v4'
                    : null,
            ])
            ->get(self::API_ENDPOINT . 'get_tor_topic_data', [
                'by' => 'topic_id',
                'val' => implode(',', $ids),
            ]);

        return new RtoGetTorTopicDataResponse($response);
    }

    public function topicIdByHash(string $hash): ?int
    {
        $response = $this->http
            ->withOptions([
                RequestOptions::FORCE_IP_RESOLVE => \App::isProduction()
                    ? 'v4'
                    : null,
            ])
            ->get(self::API_ENDPOINT . 'get_topic_id', [
                'by' => 'hash',
                'val' => $hash,
            ]);

        return $response->object()->result->{$hash};
    }
}
