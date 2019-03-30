<?php namespace App\Services;

use App\Http\GuzzleClientFactory;

class Vk
{
    const API_ENDPOINT = 'https://api.vk.com/method/';

    protected $client;
    protected $version = '5.69';
    protected $access_token = '';

    public function __construct()
    {
        $this->client = (new GuzzleClientFactory)
            ->baseUri(static::API_ENDPOINT)
            ->createForService('vk');
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

    public function likePost(Vk\Post $post)
    {
        $params = array_merge($this->params(), [
            'type' => 'post',
            'item_id' => $post->id(),
            'owner_id' => $post->ownerId(),
        ]);

        $response = $this->client->get('likes.add', ['query' => $params]);

        return json_decode($response->getBody());
    }

    public function unlikePost(Vk\Post $post)
    {
        $params = array_merge($this->params(), [
            'type' => 'post',
            'item_id' => $post->id(),
            'owner_id' => $post->ownerId(),
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

    public function wallSearch($page, array $params = [])
    {
        $params = array_merge($this->params(), $params);

        if (0 === strpos($page, '-')) {
            $params['owner_id'] = $page;
        } else {
            $params['domain'] = $page;
        }

        $response = $this->client->get('wall.search', ['query' => $params]);

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
