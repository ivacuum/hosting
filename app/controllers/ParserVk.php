<?php

class ParserVk extends BaseController
{
	protected $page;
	
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
			$json = json_decode(file_get_contents($this->getUrl($count, $offset)));
		
			/* В первом элементе количество записей */
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

		return View::make('parser.vk.index')
			->with(compact('posts'))
			->with('previous', Carbon::parse($date)->subDay())
			->with('next', Carbon::parse($date)->addDay())
			->with('page', $page)
			->with('date', $date);
	}

	protected function getPostsCount()
	{
		$json = json_decode(file_get_contents($this->getUrl(1)));
		
		return $json->response[0];
	}
	
	protected function getUrl($count = 100, $offset = 0)
	{
		return "https://api.vk.com/method/wall.get".
			"?domain={$this->page}".
			"&count={$count}".
			"&offset={$offset}";
	}
}
