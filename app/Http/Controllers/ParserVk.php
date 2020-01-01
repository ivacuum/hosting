<?php namespace App\Http\Controllers;

use App\CacheKey;
use App\Http\GuzzleClientFactory;
use App\Services\Vk;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;

class ParserVk extends Controller
{
    protected $client;
    protected $token;
    protected $version = '5.69';
    protected $vkpage;

    public function __construct()
    {
        $this->client = (new GuzzleClientFactory)
            ->baseUri(Vk::API_ENDPOINT)
            ->timeout(10)
            ->createForService('vk.parser');
    }

    public function index($vkpage = 'pn6', $date = false)
    {
        $this->vkpage = $vkpage;
        $this->token = $token = request('token', config('services.vk.access_token'));
        $own = request('own');
        $date = false === $date ? '-1 day' : $date;
        $date = CarbonImmutable::parse($date);
        $token = $token === config('services.vk.access_token') ? null : $token;

        $count = 100;
        $offset = $total = 0;
        $parsed = false;
        $posts = collect();

        $dateStart = CarbonImmutable::parse($date)->startOfDay()->timestamp;
        $dateEnd = CarbonImmutable::parse($date)->endOfDay()->timestamp;
        $previous = CarbonImmutable::parse($date)->subDay();
        $next = now()->startOfDay()->gt($date) ? CarbonImmutable::parse($date)->addDay() : null;

        while (false === $parsed) {
            $json = $this->getPosts($count, $offset);

            if (isset($json->error)) {
                throw new \Exception($json->error->error_msg);
            }

            $total = $total ?: $json->response->count;

            $json = $json->response->items;

            $portion = sizeof($json);

            if ($own) {
                $json = collect($json)->reject(fn ($post) => !empty($post->copy_history));
            }

            $json = collect($json)->reject(function ($post) {
                if (isset($post->attachments)) {
                    foreach ($post->attachments as $attach) {
                        if ($attach->type === 'link' && false !== mb_strpos($attach->link->url, 'vk.com/@')) {
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
        }

        return view('parser.vk', [
            'own' => $own,
            'date' => $date,
            'next' => $next,
            'token' => $token,
            'posts' => $posts->sortByDesc('views')->take(10),
            'vkpage' => $vkpage,
            'previous' => $previous,
        ]);
    }

    public function indexPost()
    {
        return redirect(path([self::class, 'index'], request('slug')));
    }

    protected function getPosts($count = 100, $offset = 0)
    {
        $cacheEntry = CacheKey::key(CacheKey::VK_WALL_GET, "{$this->vkpage}_{$count}_{$offset}");

        $params = [
            'v' => $this->version,
            'count' => $count,
            'filter' => 'owner',
            'offset' => $offset,
            'access_token' => $this->token,
        ];

        if (is_numeric($this->vkpage)) {
            $params['owner_id'] = $this->vkpage;
        } else {
            $params['domain'] = $this->vkpage;
        }

        return \Cache::remember($cacheEntry, CarbonInterval::minutes(15 + intval($offset / 100)), function () use ($params) {
            if ($params['access_token'] && $params['offset']) {
                sleep(1);
            }

            $response = $this->client->get('wall.get', ['query' => $params]);

            event(new \App\Events\Stats\ParserVkWallGet);

            return json_decode($response->getBody());
        });
    }

    protected function getPostsCount()
    {
        return $this->getPosts(1)->response[0];
    }
}
