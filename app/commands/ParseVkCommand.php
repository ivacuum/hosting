<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class ParseVkCommand extends Command
{
	protected $name = 'app:parse-vk';
	protected $description = 'Parse vk.com page';

	public function fire()
	{
		$count = 100;
		$date = $this->argument('date');
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
					'likes'   => $post->likes->count,
					'reposts' => $post->reposts->count,
					'text'    => $post->text,
				];
			}
			
			$offset += $count;
		}
		
		rsort($posts);
		
		if (sizeof($posts) < 10) {
			$this->error('В этот день не публиковали ничего достойного');
			return;
		}
		
		$this->info('Лучшее за ' . Carbon::parse($date)->toDateString());
		
		for ($i = 0; $i < 10; $i++) {
			$this->info(sprintf('#%d. 👍  %d, 📢  %d', $i + 1, $posts[$i]['likes'], $posts[$i]['reposts']));
			$this->comment(wordwrap(str_replace('<br>', "\n", $posts[$i]['text']), 80));
			print "\n";
		}
	}
	
	protected function getArguments()
	{
		return [
			['page', InputArgument::REQUIRED, 'Адрес страницы'],
			['date', InputArgument::REQUIRED, 'Дата постов'],
		];
	}

	protected function getPostsCount()
	{
		$json = json_decode(file_get_contents($this->getUrl(1)));
		
		return $json->response[0];
	}
	
	protected function getUrl($count = 100, $offset = 0)
	{
		return "https://api.vk.com/method/wall.get".
			"?domain=".$this->argument('page').
			"&count={$count}".
			"&offset={$offset}";
	}
}
