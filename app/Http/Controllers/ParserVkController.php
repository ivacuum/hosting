<?php

namespace App\Http\Controllers;

use App\Domain\CacheKey;
use App\Domain\Config;
use App\Services\Vk;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Sleep;

class ParserVkController
{
    protected PendingRequest $http;
    protected $token;
    protected $version = '5.131';
    protected $vkPage;

    public function __construct(Factory $http)
    {
        $this->http = $http
            ->baseUrl(Vk::API_ENDPOINT)
            ->timeout(10);
    }

    public function index(string $vkPage = 'pikabu', $date = false)
    {
        $this->vkPage = $vkPage;
        $this->token = $token = request('token', Config::VkAccessToken->get());
        $own = request('own');
        $date = $date === false ? '-1 day' : $date;
        $date = CarbonImmutable::parse($date);
        $token = $token === Config::VkAccessToken->get() ? null : $token;

        $count = 100;
        $offset = $total = 0;
        $parsed = false;
        $posts = collect();

        $dateStart = CarbonImmutable::parse($date)->startOfDay()->timestamp;
        $dateEnd = CarbonImmutable::parse($date)->endOfDay()->timestamp;
        $previous = CarbonImmutable::parse($date)->subDay();
        $next = today()->gt($date) ? CarbonImmutable::parse($date)->addDay() : null;

        while ($parsed === false) {
            $json = $this->getPosts($count, $offset);

            if (isset($json->error)) {
                throw new \Exception($json->error->error_msg);
            }

            $total = $total ?: $json->response->count;

            $json = $json->response->items;

            $portion = count($json);

            if ($own) {
                $json = collect($json)->reject(fn ($post) => !empty($post->copy_history));
            }

            $json = collect($json)->reject(function ($post) {
                if (isset($post->attachments)) {
                    foreach ($post->attachments as $attach) {
                        if ($attach->type === 'link' && str_contains($attach->link->url, 'vk.com/@')) {
                            return true;
                        }
                    }
                }

                return false;
            });

            foreach ($json as $post) {
                if (@$post->is_pinned) {
                    continue;
                }

                if ($post->date < $dateStart) {
                    $previous = CarbonImmutable::createFromTimestamp($post->date);
                    $parsed = true;
                    break 2;
                }

                if ($post->date > $dateEnd) {
                    continue;
                }

                if (mb_stripos($post->text, '#лайктайм@') !== false) {
                    continue;
                }

                $photos = 0;

                if (isset($post->attachments)) {
                    foreach ($post->attachments as $attach) {
                        if ($attach->type === 'photo') {
                            $photos++;
                        }
                    }
                }

                $posts->push([
                    'url' => "https://vk.com/wall{$post->owner_id}_{$post->id}",
                    'text' => $post->text,
                    'type' => $post->post_type,
                    'likes' => $post->likes->count,
                    'views' => $post->views->count ?? 0, // Иногда поле отсутствует
                    'photos' => $photos,
                    'reposts' => $post->reposts->count,
                    'attachment' => @$post->attachment,
                    'attachments' => @$post->attachments,
                    'copy_history' => @$post->copy_history,
                ]);
            }

            if ($offset + $portion === $total) {
                $previous = null;
                $parsed = true;
                break;
            }

            $offset += $count;

            if ($offset > 2500) {
                break;
            }
        }

        return view('parser.vk', [
            'own' => $own,
            'date' => $date,
            'next' => $next,
            'token' => $token,
            'posts' => $posts->sortByDesc('views')->take(10),
            'vkpage' => $vkPage,
            'previous' => $previous,
        ]);
    }

    public function indexPost()
    {
        return redirect(path([self::class, 'index'], request('slug')));
    }

    protected function getPosts($count = 100, $offset = 0)
    {
        $cacheEntry = CacheKey::VkWallGet->key("{$this->vkPage}_{$count}_{$offset}");

        $params = [
            'v' => $this->version,
            'count' => $count,
            'filter' => 'owner',
            'offset' => $offset,
            'access_token' => $this->token,
        ];

        if (is_numeric($this->vkPage)) {
            $params['owner_id'] = $this->vkPage;
        } else {
            $params['domain'] = $this->vkPage;
        }

        return \Cache::remember($cacheEntry, CarbonInterval::minutes(15 + intval($offset / 100)), function () use ($params) {
            if ($params['access_token'] && $params['offset']) {
                Sleep::for(1)->second();
            }

            $response = $this->http->get('wall.get', $params);

            event(new \App\Events\Stats\ParserVkWallGet);

            return $response->object();
        });
    }

    protected function getPostsCount()
    {
        return $this->getPosts(1)->response[0];
    }
}
