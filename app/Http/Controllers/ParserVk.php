<?php namespace App\Http\Controllers;

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

    public function index($vkpage = 'pn6', $date = false)
    {
        $this->vkpage = $vkpage;
        $own = $this->request->input('own');
        $date = false === $date ? '-1 day' : $date;
        $date = Carbon::parse($date);

        $count = 100;
        $offset = 0;
        $total = 0;
        $parsed = false;
        $posts = collect();

        $date_start = Carbon::parse($date)->startOfDay()->timestamp;
        $date_end = Carbon::parse($date)->endofDay()->timestamp;
        $previous = Carbon::parse($date)->subDay();
        $next = Carbon::now()->startOfDay()->gt($date) ? Carbon::parse($date)->addDay() : null;

        while (false === $parsed) {
            $json = $this->getPosts($count, $offset);

            if (isset($json->error)) {
                dd($json->error);
            }

            $json = $json->response;

            $total = $total ?: $json[0];

            // В первом элементе количество записей
            for ($i = 1, $len = sizeof($json) - 1; $i < $len; $i++) {
                $post = $json[$i];

                if (@!$post->is_pinned && $post->date < $date_start) {
                    $previous = Carbon::createFromTimestamp($post->date);
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

                $posts->push([
                    'likes'       => $post->likes->count,
                    'reposts'     => $post->reposts->count,
                    'url'         => "https://vk.com/wall{$post->to_id}_{$post->id}",
                    'text'        => $post->text,
                    'type'        => $post->post_type,
                    'photos'      => $photos,
                    'attachment'  => @$post->attachment,
                    'attachments' => @$post->attachments,
                ]);
            }

            if ($offset + $i === $total) {
                $previous = null;
                $parsed = true;
                break;
            }

            $offset += $count;
        }

        if ($own) {
            $posts = $posts->reject(function ($post) {
                return $post['type'] === 'copy';
            });
        }

        $posts = $posts->sortByDesc('likes')->take(10);

        return view('parser.vk', compact(
            'date',
            'next',
            'own',
            'posts',
            'previous',
            'vkpage'
        ));
    }

    public function indexPost()
    {
        return redirect()->action("{$this->class}@index", $this->request->input('slug'));
    }

    protected function getPosts($count = 100, $offset = 0)
    {
        $cache_entry = "vk_{$this->vkpage}_{$count}_{$offset}";
        $filter = 'owner';
        $params = compact('count', 'filter', 'offset');

        if (is_numeric($this->vkpage)) {
            $params['owner_id'] = $this->vkpage;
        } else {
            $params['domain'] = $this->vkpage;
        }

        return \Cache::remember($cache_entry, 15 + intval($offset / 100), function () use ($params) {
            $response = $this->client->get('wall.get', ['query' => $params]);

            return json_decode($response->getBody());
        });
    }

    protected function getPostsCount()
    {
        return $this->getPosts(1)->response[0];
    }
}
