<?php namespace App\Services;

use GuzzleHttp\Client;

class Vk
{
    const API_ENDPOINT = 'https://api.vk.com/method/';

    protected $client;
    protected $version = '5.60';
    protected $access_token = '';

    public function __construct()
    {
        $this->client = new Client(['base_uri' => self::API_ENDPOINT]);
    }

    public function accessToken($access_token)
    {
        $this->access_token = $access_token;

        return $this;
    }

    public function version($version)
    {
        $this->version = $version;

        return $this;
    }

    public function execute($code)
    {
        $params = array_merge($this->params(), ['code' => $code]);

        $response = $this->client->get('execute', ['query' => $params]);

        return json_decode($response->getBody());
    }

    public function likePost($owner_id, $id)
    {
        $params = array_merge($this->params(), [
            'type' => 'post',
            'item_id' => $id,
            'owner_id' => $owner_id,
        ]);

        $response = $this->client->get('likes.add', ['query' => $params]);

        return json_decode($response->getBody());
    }

    public function unlikePost($owner_id, $id)
    {
        $params = array_merge($this->params(), [
            'type' => 'post',
            'item_id' => $id,
            'owner_id' => $owner_id,
        ]);

        $response = $this->client->get('likes.delete', ['query' => $params]);

        return json_decode($response->getBody());
    }

    public function wallGet($page, array $params = [])
    {
        $params = array_merge($this->params(), $params);

        if (0 === strpos($page, '-')) {
            $params['owner_id'] = $page;
        } else {
            $params['domain'] = $page;
        }

        $response = $this->client->get('wall.get', ['query' => $params]);

        return json_decode($response->getBody());
    }

    protected function params()
    {
        return [
            'v' => $this->version,
            'access_token' => $this->access_token,
        ];
    }
}
