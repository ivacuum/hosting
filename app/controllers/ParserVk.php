<?php

use GuzzleHttp\Client;

class ParserVk extends BaseController
{
	protected $client;
	protected $page;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->client = new Client(['base_url' => 'https://api.vk.com/method/']);
	}
	
	public function index($page = 'palnom6', $date = false)
	{
		$this->page = $page;
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
			
				if ($post->date > $date_end || !$post->text || @$post->is_pinned) {
					continue;
				}
				
				$posts[] = [
					'likes'       => $post->likes->count,
					'reposts'     => $post->reposts->count,
					'url'         => "https://vk.com/wall{$post->to_id}_{$post->id}",
					'text'        => $post->text,
					'attachment'  => @$post->attachment,
					'attachments' => @$post->attachments,
				];
			}
			
			$offset += $count;
		}
		
		rsort($posts);
		
		$posts = array_slice($posts, 0, 10);

		return View::make('parser.vk.index', compact('posts', 'page', 'date'))
			->with('previous', Carbon::parse($date)->subDay())
			->with('next', Carbon::parse($date)->addDay());
	}
	
	protected function getPosts($count = 100, $offset = 0)
	{
		$cache_entry = "vk_{$this->page}_{$count}_{$offset}";
		$domain = $this->page;
		$params = compact('domain', 'count', 'offset');
		
		return Cache::remember($cache_entry, 5, function() use ($params) {
			$response = $this->client->get('wall.get', ['query' => $params]);
		
			return $response->json(['object' => true]);
		});
	}

	protected function getPostsCount()
	{
		return $this->getPosts(1)->response[0];
	}
}
