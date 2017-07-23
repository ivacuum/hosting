<?php namespace App\Services;

use App\Torrent;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Rto
{
    const API_ENDPOINT = 'http://api.rutracker.org/v1/';
    const SITE_ENDPOINT = 'http://rutracker.cr/forum/';

    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => self::API_ENDPOINT]);
    }

    public function findTopicId($input)
    {
        $topic_id = 0;

        if (is_numeric($input)) {
            $topic_id = (int) $input;
        } elseif (starts_with($input, 'http')) {
            if (str_contains($input, ['://rutracker.org', '://rutracker.cr', '://rutracker.net', '://maintracker.org'])) {
                $url = parse_url($input);

                if (!isset($url['query'])) {
                    return;
                }

                parse_str($url['query'], $args);

                if (!isset($args['t'])) {
                    return;
                }

                $topic_id = (int) $args['t'];
            }
        } elseif (strlen($input) === 40) {
            $topic_id = $this->topicIdByHash($input);

            if (is_null($topic_id)) {
                return;
            }
        }

        if (!$topic_id) {
            return;
        }

        return $topic_id;
    }

    public function torrentData($input)
    {
        if (is_null($topic_id = $this->findTopicId($input))) {
            return;
        }

        return $this->parseTopicData($topic_id);
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
            return;
        }

        return $link->attr('href');
    }

    public function parseTopicBody($topic_id)
    {
        $response = $this->client->get(self::SITE_ENDPOINT . "viewtopic.php?t={$topic_id}");

        $body = (string) $response->getBody();
        $magnet = $this->parseMagnetLink($body);

        if (is_null($magnet)) {
            return 'Магнет-ссылка не найдена в раздаче, попробуйте другую ссылку';
        }

        $link = $this->parseAnnouncerLink($magnet);

        return [
            'body' => $this->parseBodyHtml($body),
            'magnet' => $magnet,
            'announcer' => $link->announcer,
        ];
    }

    public function parseTopicData($topic_id)
    {
        $json = $this->topicDataById($topic_id);

        if (is_null($json)) {
            return 'Раздача не найдена, попробуйте другую ссылку';
        }

        if ($json->tor_status === Torrent::RTO_STATUS_DUPLICATE) {
            return 'Раздача закрыта как повторная, попробуйте другую ссылку';
        }

        if (!is_array($topic_body_data = $this->parseTopicBody($topic_id))) {
            return $topic_body_data;
        }

        return array_merge([
            'size' => $json->size,
            'title' => $json->topic_title,
            'rto_id' => $topic_id,
            'seeders' => $json->seeders,
            'reg_time' => $json->reg_time,
            'info_hash' => $json->info_hash,
            'tor_status' => $json->tor_status,
        ], $topic_body_data);
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

        $response = $this->client->get('get_tor_topic_data', ['query' => $params]);

        return json_decode($response->getBody())->result;
    }

    public function topicIdByHash($hash)
    {
        $params = [
            'by' => 'hash',
            'val' => $hash,
        ];

        $response = $this->client->get('get_topic_id', ['query' => $params]);

        return json_decode($response->getBody())->result->{$hash};
    }
}
