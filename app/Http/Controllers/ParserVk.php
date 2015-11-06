<?php

namespace App\Http\Controllers;

use Cache;
use Carbon\Carbon;
use GuzzleHttp\Client;

class ParserVk extends Controller
{
    protected $client;
    protected $vkpage;

    public function __construct()
    {
        parent::__construct();

        $this->client = new Client(['base_uri' => 'https://api.vk.com/method/']);
    }

    public function index($vkpage = 'palnom6', $date = false)
    {
        $this->vkpage = $vkpage;
        $date = false === $date ? '-1 day' : $date;
        $date = Carbon::parse($date);

        $count = 100;
        $offset = 0;
        $parsed = false;
        $posts = [];

        $total = $this->getPostsCount();
        $date_start = Carbon::parse($date)->startOfDay()->timestamp;
        $date_end = Carbon::parse($date)->endofDay()->timestamp;

        while (false === $parsed) {
            $json = $this->getPosts($count, $offset);

            // В первом элементе количество записей
            for ($i = 1, $len = sizeof($json->response) - 1; $i < $len; $i++) {
                $post = $json->response[$i];

                if (@!$post->is_pinned && $post->date < $date_start) {
                    $parsed = true;
                    break 2;
                }

                if ($post->date > $date_end || @$post->is_pinned) {
                    continue;
                }

                $photos = 0;

                if (isset($post->attachments)) {
                    foreach ($post->attachments as $attach) {
                        if ($attach->type == 'photo') {
                            $photos++;
                        }
                    }
                }

                $posts[] = [
                    'likes'       => $post->likes->count,
                    'reposts'     => $post->reposts->count,
                    'url'         => "https://vk.com/wall{$post->to_id}_{$post->id}",
                    'text'        => $post->text,
                    'photos'      => $photos,
                    'attachment'  => @$post->attachment,
                    'attachments' => @$post->attachments,
                ];
            }

            $offset += $count;
        }

        rsort($posts);

        $posts = array_slice($posts, 0, 10);

        return view('parser.vk', compact('posts', 'vkpage', 'date'))
            ->withPrevious(Carbon::parse($date)->subDay())
            ->withNext(Carbon::parse($date)->addDay());
    }

    protected function getPosts($count = 100, $offset = 0)
    {
        $cache_entry = "vk_{$this->vkpage}_{$count}_{$offset}";
        $domain = $this->vkpage;
        $params = compact('domain', 'count', 'offset');

        return Cache::remember($cache_entry, 15, function() use ($params) {
            $response = $this->client->get('wall.get', ['query' => $params]);

            return json_decode($response->getBody());
        });
    }

    protected function getPostsCount()
    {
        return $this->getPosts(1)->response[0];
    }
}
