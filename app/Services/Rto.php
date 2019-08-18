<?php namespace App\Services;

use App\Http\GuzzleClientFactory;
use App\Torrent;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class Rto
{
    const API_ENDPOINT = 'http://api.rutracker.org/v1/';

    // Зеркала: rutracker.org, rutracker.cr, xn--e1aaowadjh.org, dostup.website/https://rutracker.org
    const SITE_ENDPOINT = 'https://rutracker.nl/forum/';

    protected $client;

    public function __construct()
    {
        $this->client = (new GuzzleClientFactory)
            ->timeout(5)
            ->createForService('rto');
    }

    public function findTopicId($input)
    {
        $topicId = 0;

        if (is_numeric($input)) {
            $topicId = (int) $input;
        } elseif (Str::startsWith($input, 'http')) {
            if (Str::contains($input, ['://rutracker.org', '://rutracker.cr', '://rutracker.net', '://rutracker.nl', '://maintracker.org'])) {
                $url = parse_url($input);

                if (!isset($url['query'])) {
                    return null;
                }

                parse_str($url['query'], $args);

                if (!isset($args['t'])) {
                    return null;
                }

                $topicId = (int) $args['t'];
            }
        } elseif (strlen($input) === 40) {
            $topicId = $this->topicIdByHash($input);

            if (null === $topicId) {
                return null;
            }
        }

        if (!$topicId) {
            return null;
        }

        return $topicId;
    }

    public function torrentData($input)
    {
        if (null === $topicId = $this->findTopicId($input)) {
            return null;
        }

        return $this->parseTopicData($topicId);
    }

    public function parseAnnouncerLink($link)
    {
        parse_str($link, $args);

        return (object) [
            'title' => $args['dn'] ?? '',
            'announcer' => $args['tr'] ?? '',
        ];
    }

    public function parseBodyHtml($body)
    {
        $body = preg_replace('/<fieldset class="attach">(.*?)<\/fieldset>/s', '', $body);

        $crawler = new Crawler($body);

        return trim($crawler->filter('.post_body')->html());
    }

    public function parseMagnetLink($body)
    {
        $crawler = new Crawler($body);

        if (sizeof($link = $crawler->filter('.attach_link a')) === 0) {
            return null;
        }

        return $link->attr('href');
    }

    public function parseTopicBody($topicId)
    {
        $response = $this->client->get(static::SITE_ENDPOINT . "viewtopic.php?t={$topicId}");

        $body = (string) $response->getBody();
        $magnet = $this->parseMagnetLink($body);

        if (null === $magnet) {
            return 'Магнет-ссылка не найдена в раздаче, попробуйте другую ссылку';
        }

        $link = $this->parseAnnouncerLink($magnet);

        return [
            'body' => $this->parseBodyHtml($body),
            'magnet' => $magnet,
            'announcer' => $link->announcer,
        ];
    }

    public function parseTopicData($topicId)
    {
        $json = $this->topicDataById($topicId);

        if (null === $json) {
            return 'Раздача не найдена, попробуйте другую ссылку';
        }

        if ($json->tor_status === Torrent::RTO_STATUS_DUPLICATE) {
            return 'Раздача закрыта как повторная, попробуйте другую ссылку';
        }

        if (!is_array($topicBodyData = $this->parseTopicBody($topicId))) {
            return $topicBodyData;
        }

        return array_merge([
            'size' => $json->size,
            'title' => str_replace(Torrent::TITLE_REPLACE_FROM, Torrent::TITLE_REPLACE_TO, $json->topic_title),
            'rto_id' => $topicId,
            'reg_time' => $json->reg_time,
            'info_hash' => $json->info_hash,
            'tor_status' => $json->tor_status,
        ], $topicBodyData);
    }

    public function topicDataById($id)
    {
        return $this->topicDataByIds($id)->{$id};
    }

    public function topicDataByIds($ids)
    {
        $params = [
            'by' => 'topic_id',
            'val' => $ids,
        ];

        $response = $this->client->get(static::API_ENDPOINT . 'get_tor_topic_data', ['query' => $params]);

        return json_decode($response->getBody())->result;
    }

    public function topicIdByHash($hash)
    {
        $params = [
            'by' => 'hash',
            'val' => $hash,
        ];

        $response = $this->client->get(static::API_ENDPOINT . 'get_topic_id', ['query' => $params]);

        return json_decode($response->getBody())->result->{$hash};
    }
}
