<?php

namespace App\Services;

use App\Domain\Config;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Client\Factory;

class Rto
{
    private const string API_ENDPOINT = 'https://api-rto.vacuum.name/v1/';
    private const string SITE_ENDPOINT = 'https://rto.vacuum.name/forum/';

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

    public function torrentData($input): RtoTorrentData|null
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
        $response = $this->configureSiteClient()
            ->get("viewtopic.php?t={$topicId}");

        return new RtoTopicHtmlResponse($response->body());
    }

    public function topicDataById(int $id)
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

    public function topicDataByIds(array $ids): RtoGetTorTopicDataResponse
    {
        $response = $this->configureApiClient()
            ->get('get_tor_topic_data', [
                'by' => 'topic_id',
                'val' => implode(',', $ids),
            ]);

        return new RtoGetTorTopicDataResponse($response);
    }

    public function topicIdByHash(string $hash): int|null
    {
        $response = $this->configureApiClient()
            ->get('get_topic_id', [
                'by' => 'hash',
                'val' => $hash,
            ]);

        return $response->object()->result->{$hash};
    }

    private function configureApiClient()
    {
        return $this->http
            ->baseUrl(self::API_ENDPOINT)
            ->timeout(\App::runningInConsole() ? 60 : 15)
            ->withOptions([
                RequestOptions::PROXY => Config::RtoProxy->get(),
            ]);
    }

    private function configureSiteClient()
    {
        return $this->http
            ->baseUrl(self::SITE_ENDPOINT)
            ->timeout(\App::runningInConsole() ? 60 : 15)
            ->retry(5, 5000)
            ->withOptions([
                RequestOptions::PROXY => Config::RtoProxy->get(),
            ]);
    }
}
