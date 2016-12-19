<?php namespace App\Services;

use App\Torrent;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Rto
{
    const API_ENDPOINT = 'http://api.rutracker.org/v1/';
    const SITE_ENDPOINT = 'http://rutracker.org/forum/';

    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => self::API_ENDPOINT]);
    }

    public function torrentData($input)
    {
        $topic_id = 0;

        if (is_numeric($input)) {
            $topic_id = (int) $input;
        } elseif (starts_with($input, 'http')) {
            if (str_contains($input, ['://rutracker.org', '://maintracker.org'])) {
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

    public function parseBbcode($body)
    {
        $body = str_replace(
            ["\n", "\t", '<span class="post-br"><br /></span>', '<br />'],
            ['', '', "\n", "\n"],
            $body
        );

        $body = preg_replace('/<fieldset class="attach">(.*?)<\/fieldset>/s', '', $body);
        $body = preg_replace('/<span class="post-i">(.*?)<\/span>/s', '[i]$1[/i]', $body);
        $body = preg_replace('/<span class="post-b">(.*?)<\/span>/s', '[b]$1[/b]', $body);
        $body = preg_replace('/<div class="sp-wrap">\s*<div class="sp-head folded"><span>(.*?)<\/span><\/div>\s*<div class="sp-body">(.*?)<\/div>\s*<\/div>/s', "\n[spoiler=\"$1\"]\n$2\n[/spoiler]", $body);
        $body = preg_replace('/<var class="postImg postImgAligned img-right" title="(.*?)">(.*?)<\/var>/s', '[img=right]$1[/img]', $body);
        $body = preg_replace('/<var class="postImg" title="(.*?)">(.*?)<\/var>/s', '[img]$1[/img]', $body);
        $body = preg_replace('/<a href="(.*?)" class="postLink">\[img\](.*?)\[\/img\]<\/a>/', '[url=$1][img]$2[/img][/url]', $body);

        return $body;
    }

    public function parseBodyHtml($body)
    {
        $body = preg_replace('/<fieldset class="attach">(.*?)<\/fieldset>/s', '', $body);

        $crawler = new Crawler($body);

        return $crawler->filter('.post_body')->html();
    }

    public function parseMagnetLink($body)
    {
        $crawler = new Crawler($body);

        if (sizeof($link = $crawler->filter('.attach_link a')) === 0) {
            return;
        }

        return $link->attr('href');
    }

    public function parseTopicData($topic_id)
    {
        $json = $this->topicDataById($topic_id);

        if (is_null($json)) {
            return 'Раздача не найдена, попробуйте другую ссылку';
        }

        if ($json->tor_status === Torrent::STATUS_DUPLICATE) {
            return 'Раздача закрыта как повторная, попробуйте другую ссылку';
        }

        $response = $this->client->get(self::SITE_ENDPOINT . "viewtopic.php?t={$topic_id}");

        $body = (string) $response->getBody();
        $magnet = $this->parseMagnetLink($body);

        if (is_null($magnet)) {
            return 'Магнет-ссылка не найдена в раздаче, попробуйте другую ссылку';
        }

        $link = $this->parseAnnouncerLink($magnet);

        return [
            'size' => $json->size,
            'body' => $this->parseBodyHtml($body),
            'title' => $json->topic_title,
            'rto_id' => $topic_id,
            'magnet' => $magnet,
            'seeders' => $json->seeders,
            'reg_time' => $json->reg_time,
            'info_hash' => $json->info_hash,
            'announcer' => $link->announcer,
            'tor_status' => $json->tor_status,
        ];
    }

    public function topicDataById($id)
    {
        $params = [
            'by' => 'topic_id',
            'val' => $id,
        ];

        $response = $this->client->get('get_tor_topic_data', ['query' => $params]);

        return json_decode($response->getBody())->result->{$id};
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
