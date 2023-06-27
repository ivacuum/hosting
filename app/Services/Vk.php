<?php

namespace App\Services;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;

class Vk
{
    public const API_ENDPOINT = 'https://api.vk.com/method/';

    protected PendingRequest $http;
    protected $version = '5.131';
    protected $accessToken = '';

    public function __construct(Factory $http)
    {
        $this->http = $http
            ->baseUrl(self::API_ENDPOINT)
            ->timeout(10);
    }

    public function accessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function version(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function execute($code)
    {
        $params = array_merge($this->params(), ['code' => $code]);

        $response = $this->http->get('execute', $params);

        return $response->object();
    }

    public function likePost(Vk\Post $post)
    {
        $params = array_merge($this->params(), [
            'type' => 'post',
            'item_id' => $post->id(),
            'owner_id' => $post->ownerId(),
        ]);

        $response = $this->http->get('likes.add', $params);

        return $response->object();
    }

    public function unlikePost(Vk\Post $post)
    {
        $params = array_merge($this->params(), [
            'type' => 'post',
            'item_id' => $post->id(),
            'owner_id' => $post->ownerId(),
        ]);

        $response = $this->http->get('likes.delete', $params);

        return $response->object();
    }

    public function wallGet(string $page, array $params = [])
    {
        $params = array_merge($this->params(), $params);

        if (str_starts_with($page, '-')) {
            $params['owner_id'] = $page;
        } else {
            $params['domain'] = $page;
        }

        $response = $this->http->get('wall.get', $params);

        return $response->object();
    }

    public function wallSearch($page, array $params = [])
    {
        $params = array_merge($this->params(), $params);

        if (str_starts_with($page, '-')) {
            $params['owner_id'] = $page;
        } else {
            $params['domain'] = $page;
        }

        $response = $this->http->get('wall.search', $params);

        return $response->object();
    }

    protected function params(): array
    {
        return [
            'v' => $this->version,
            'access_token' => $this->accessToken,
        ];
    }
}
