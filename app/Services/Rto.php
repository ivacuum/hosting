<?php namespace App\Services;

use App\Http\GuzzleClientFactory;

class Rto
{
    const API_ENDPOINT = 'http://api.rutracker.org/v1/';
    const SITE_ENDPOINT = 'https://rutracker.org/forum/';

    private $client;

    public function __construct(GuzzleClientFactory $clientFactory)
    {
        $this->client = $clientFactory
            ->timeout(\App::runningInConsole() ? 60 : 15)
            ->forceIp6ForProd()
            ->createForService('rto');
    }

    public function findTopicId($input): ?int
    {
        if (is_numeric($input)) {
            return $input;
        }

        if ($input === null) {
            return null;
        }

        if (\Str::startsWith($input, 'http')) {
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
        $response = $this->client->get(self::SITE_ENDPOINT . "viewtopic.php?t={$topicId}", [
            'proxy' => env('RTO_PROXY'),
        ]);

        return new RtoTopicHtmlResponse((string) $response->getBody());
    }

    public function topicDataById(int $id)
    {
        $response = $this->topicDataByIds([$id])
            ->getTopic($id);

        if (null === $response) {
            throw new RtoTopicNotFoundException;
        }

        if ($response->isDuplicate()) {
            throw new RtoTopicDuplicateException;
        }

        return $response;
    }

    public function topicDataByIds(array $ids): RtoGetTorTopicDataResponse
    {
        $response = $this->client->get(self::API_ENDPOINT . 'get_tor_topic_data', ['query' => [
            'by' => 'topic_id',
            'val' => implode(',', $ids),
        ]]);

        return new RtoGetTorTopicDataResponse($response);
    }

    public function topicIdByHash(string $hash): ?int
    {
        $response = $this->client->get(self::API_ENDPOINT . 'get_topic_id', ['query' => [
            'by' => 'hash',
            'val' => $hash,
        ]]);

        return json_decode((string) $response->getBody())->result->{$hash};
    }
}
